<?php

namespace App\Http\Services;

use App\Mail\ConfirmEmailUpdate;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as FormattedCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

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
        $this->filterDataQuery($aFilter);
        $this->sortDataQuery($aFilter);
    }

    private function filterDataQuery(array $aFilter) : void
    {
        $aRelationShips = [
            'userStatus',
            'userRole',
            'federation',
            'localUnion',
        ];
        $this->oUserModelBuilder = User::with($aRelationShips);
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
    }

    private function sortDataQuery(array $aFilter) : void
    {
        $aColumns = [
            'fullname',
            'email',
            'federation.name',
            'local_union.name',
            'userStatus.description',
            'userRole.description',
        ];
        if (isset($aFilter['order']) === false) {
            $iColumn = $aColumns[0];
            $sAsc = 'asc';
        } else {
            $iColumn = $aColumns[$aFilter['order'][0]['column']];
            $sAsc = $aFilter['order'][0]['dir'];
        }
        $this->oUserModelBuilder->orderBy($iColumn, $sAsc);
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
                'actions'     => 'ACTION',
            ];
        });
        return $aFormattedUsers;
    }
        
    /**
     * getUsersProfileData
     *
     * @return Collection
     */
    public function getUsersProfileData() : Collection
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