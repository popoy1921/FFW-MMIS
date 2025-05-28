<?php

namespace App\Http\Services;

use App\Models\Federation;
use App\Models\User;
use Illuminate\Support\Collection as FormattedCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class that would handle any logic for User
 */
class UserService extends BaseService
{    
    private Builder $oUserModelBuilder;
    private string  $sTable;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $aRelationShips = [
            'userStatus',
            'userRole',
            'federation',
            'localUnion',
        ];
        $this->oUserModelBuilder = User::with($aRelationShips);
    }
    
    /**
     * set Defaults to get the initial count
     *
     * @param  mixed $aInputs
     * @return void
     */
    public function setDefaults(array $aInputs) : void
    {
        $this->sTable = $aInputs['table'];
        if (isset($aInputs['role_limit'])) {
            $this->oUserModelBuilder->whereHas('userRole', function($query) use ($aInputs) {
                $query->where('id', '>=', $aInputs['role_limit']);
            });
        }
        if (isset($aInputs['default_role_id'])) {
            $this->oUserModelBuilder->where('role_id', $aInputs['default_role_id']);
            if ($aInputs['default_role_id'] === 3) {
                $this->oUserModelBuilder->whereNotNull('local_union_id');
            }
        }
        if (isset($aInputs['default_federation'])) {
            $this->oUserModelBuilder->whereHas('federation', function($query) use ($aInputs) {
                $query->where('name', 'like', '%' . $aInputs['default_federation'] . '%');
            });
        }
    }

    /**
     * get Count of current filter data
     *
     * @return int
     */
    public function getCount() : int
    {
        return $this->oUserModelBuilder->count();
    }

    /**
     * getFormattedTableData
     *
     * @param  mixed $aFilter
     * @return array
     */
    public function getFormattedTableData(array $aFilter) : array
    {
        $this->setUserModelQueries($aFilter);
        $iNumberOfFilteredRecords = $this->getCount();

        $iNumberOfRecords = (int)$aFilter['length'];
        $iPage = ((int)$aFilter['start'] / $iNumberOfRecords) + 1;
        $oUserRecords = $this->getPaginatedRecords($this->oUserModelBuilder, $iPage, $iNumberOfRecords);

        return array(
            'draw'            => intval($aFilter['draw']),              // Return the draw counter
            // MOVED to another function and assigned using controller
            //'recordsTotal'    => User::count(),                         // Total records without filtering
            'recordsFiltered' => $iNumberOfFilteredRecords,             // Total records after filtering
            'data'            => $this->formatTableData($oUserRecords), // Data for the current page
        );
    }

    /**
     * prepare model for get and count of filtered
     *
     * @param  array $aFilter
     * @return void
     */
    public function setUserModelQueries(array $aFilter) : void
    {
        $this->filterDataQuery($aFilter);
        $this->sortDataQuery($aFilter);
    }

    private function filterDataQuery(array $aFilter) : void
    {
        if (isset($aFilter['fullname'])) {
            $this->oUserModelBuilder->where('fullname', 'like', '%' . $aFilter['fullname'] . '%');
        }
        if (isset($aFilter['email'])) {
            $this->oUserModelBuilder->where('email', 'like', '%' . $aFilter['email'] . '%');
        }
        if (isset($aFilter['role_id'])) {
            $this->oUserModelBuilder->where('role_id', $aFilter['role_id']);
        }
        if (isset($aFilter['status_id'])) {
            $this->oUserModelBuilder->where('status_id', $aFilter['status_id']);
        }
        if (isset($aFilter['federation'])) {
            $this->oUserModelBuilder->whereHas('federation', function($query) use ($aFilter) {
                $query->where('name', 'like', '%' . $aFilter['federation'] . '%');
            });
        }
        if (isset($aFilter['local_union'])) {
            $this->oUserModelBuilder->whereHas('localUnion', function($query) use ($aFilter) {
                $query->where('name', 'like', '%' . $aFilter['local_union'] . '%');
            });
        }
    }

    private function sortDataQuery(array $aFilter) : void
    {
        $aColumns = [
            'fullname',
            'email',
            'federations.name.federation_id',
            'local_unions.name.local_union_id',
            'lu_user_roles.description.role_id',
            'lu_user_statuses.description.status_id',
        ];
        if ($this->sTable === 'federation-point-person-datatable') {
            $aColumns = [
                'fullname',
                'email',
                'lu_user_statuses.description.status_id',
            ];
        }
        $iIndexForLookup = 2;
        if (isset($aFilter['order']) === false) {
            $iColumnNumber = 0;
            $sColumn = $aColumns[0];
            $sAsc = 'asc';
        } else {
            $iColumnNumber = $aFilter['order'][0]['column'];
            $sColumn = $aColumns[$aFilter['order'][0]['column']];
            $sAsc = $aFilter['order'][0]['dir'];
        }
                  
        if ($iColumnNumber < $iIndexForLookup) {
            $this->oUserModelBuilder->orderBy($sColumn, $sAsc);
        } else {
            $sUserTableName = $this->oUserModelBuilder->getModel()->getTable();
            $aColumnsValues = explode('.', $sColumn);
            $sTableName = $aColumnsValues[0];        
            $sUserFieldId = $sUserTableName . '.' . $aColumnsValues[2];
            $sForiegnIdFieldName = $sTableName . '.id';
            $this->oUserModelBuilder->leftJoin($sTableName, $sUserFieldId, '=', $sForiegnIdFieldName);
            $sFieldName = $aColumnsValues[0] . '.' . $aColumnsValues[1];
            $this->oUserModelBuilder->orderByRaw($sFieldName . ' '.  $sAsc);
        }
    }

    
    /**
     * Update format of the users data for page rendering when using API
     *
     * @param  mixed $oUsers
     * @return FormattedCollection
     */
    private function formatTableData(LengthAwarePaginator $oUsers) : FormattedCollection
    {
        $aFormattedUsers = $oUsers->map(function ($oUser) {
            return [
                'fullname'    => $oUser->fullname,
                'email'       => $oUser->email,
                'federation'  => $oUser->federation ? $oUser->federation->name : '',
                'local_union' => $oUser->localUnion ? $oUser->localUnion->name : '',
                'status'      => $oUser->userStatus->description,
                'role'        => $oUser->userRole->description,
                'actions'     => '<a class="btn btn-sm btn-primary" title="View Details" href="'. route('admin.user-details') . '?guid=' . $oUser->guid . '"><i class="fa fa-search" aria-hidden="true"></i></a>',
            ];
        });
        return $aFormattedUsers;
    }
        
    /**
     * getUsersProfileData
     */
    public function getUsersProfileData()
    {
        return User::with('userRole')->where('guid', auth()->user()->guid)->first();
    }

    /**
     * getUsersProfileData
     */
    public function getUsersDetails(string $sGuid)
    {
        return User::with('userRole')->where('guid', $sGuid)->first();
    }
    
    /**
     * update the user record specifically name fields and sending email update confirmation 
     *
     * @return String
     */
    public function createUpdate(array $aUser) : Federation|array
    {
        $aUser['fname'] = trim($aUser['fname']);
        $aUser['mname'] = trim($aUser['mname']);
        $aUser['lname'] = trim($aUser['lname']);
        $aUser['email'] = trim($aUser['email']);
        if(is_null($aUser['mname']) === true) {
            $aUser['fullname'] = $aUser['fname'] . ' ' . $aUser['lname']; 
        } else {
            $aUser['fullname'] = $aUser['fname'] . ' ' . $aUser['mname'] . ' ' . $aUser['lname'];
        }
        if (isset($aUser['id']) === true) {
            $iUserId = $aUser['id'];
            unset($aUser['id']);
        } else {
            $iUserId = (User::firstwhere('guid', $aUser['guid'])->id);
        }

        if ((int)$iUserId == 0) {
            $oUser = User::create($aUser);
        } else {
            $oUser = User::updateOrCreate(
                ['id' => $iUserId],
                $aUser,
            );
        }
        if (isset($aUser['federation_id']) === false) {
            return array();
        }
        return Federation::firstwhere('id', $aUser['federation_id']);
    }
            
    /**
     * update password for a user record 
     *
     * @return void
     */
    public function updatePassword(array $aUpdatePassword) : void
    {
        $oUser = User::firstwhere('guid', $aUpdatePassword['guid']);
        $oUser->password = Hash::make($aUpdatePassword['password']);
        $oUser->save();
    }
}