<?php

namespace App\Http\Services;

use App\Mail\ConfirmEmailUpdate;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as FormattedCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class that would handle any logic for User Role
 */
class UserService extends BaseService
{    
    private Builder $oUserModelBuilder;
    
    /**
     * getFormattedTableData
     *
     * @param  mixed $aFilter
     * @return array
     */
    public function getFormattedTableData(array $aFilter) : array
    {
        $this->setUserModelQueries($aFilter);
        $iNumberOfFilteredRecords = $this->oUserModelBuilder->count();

        $iNumberOfRecords = (int)$aFilter['length'];
        $iPage = ((int)$aFilter['start'] / $iNumberOfRecords) + 1;
        $oUserRecords = $this->getPaginatedRecords($this->oUserModelBuilder, $iPage, $iNumberOfRecords);
        return array(
            'draw'            => intval($aFilter['draw']),              // Return the draw counter
            'recordsTotal'    => User::count(),                         // Total records without filtering
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
        $aRelationShips = [
            'userStatus',
            'userRole',
            'federation',
            'localUnion',
        ];
        $this->oUserModelBuilder = User::with($aRelationShips);
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
        if (isset($aFilter['role_id'])) {
            $this->oUserModelBuilder->where('role_id', $aFilter['role_id']);
        }
        if (isset($aFilter['status_id'])) {
            $this->oUserModelBuilder->where('status_id', $aFilter['status_id']);
        }        
        if (isset($aFilter['role_limit'])) {
            $this->oUserModelBuilder->whereHas('userRole', function($query) use ($aFilter) {
                $query->where('id', '>=', $aFilter['role_limit']);
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
            'lu_user_statuses.description.status_id',
            'lu_user_roles.description.role_id',
        ];
        $iIndexForLookup = 2;
        if (isset($aFilter['order']) === false) {
            $iColumNumber = 0;
            $sColumn = $aColumns[0];
            $sAsc = 'asc';
        } else {
            $iColumNumber = $aFilter['order'][0]['column'];
            $sColumn = $aColumns[$aFilter['order'][0]['column']];
            $sAsc = $aFilter['order'][0]['dir'];
        }
                  
        if ($iColumNumber < $iIndexForLookup) {
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
                'actions'     => '<a class="btn btn-primary" href="'. route('admin.user-details') . '?guid=' . $oUser->guid . '">View Details</a>',
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
     * update the user record specifically name fields and sending email update confirmation 
     *
     * @return array
     */
    public function update(array $aUser) : array
    {
        $oUser = User::firstwhere('guid', $aUser['guid']);
        $oUser->fname = trim($aUser['fname']);
        $oUser->mname = trim($aUser['mname']);
        $oUser->lname = trim($aUser['lname']);
        $oUser->email = trim($aUser['email']);
        if(is_null($aUser['mname']) === true) {
            $oUser->fullname = $oUser->fname . ' ' . $oUser->lname; 
        } else {
            $oUser->fullname = $oUser->fname . ' ' . $oUser->mname . ' ' . $oUser->lname;
        }
        $oUser->save();

        return array();
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