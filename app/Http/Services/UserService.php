<?php

namespace App\Http\Services;

use App\Mail\ConfirmEmailUpdate;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class that would handle any logic for User Role
 */
class UserService extends BaseService
{    
    /**
     * getUsersTableData
     *
     * @param array $aFilter
     * @return array
     */
    public function getUsersTableData(array $aFilter) : LengthAwarePaginator
    {
        $aRelationShips = [
            'userStatus',
            'userRole',
            'federation',
            'localUnion',
        ];
        $oUsers = User::with($aRelationShips);
        if (isset($aFilter['fullname'])) {
            $oUsers->where('fullname', 'like', '%' . $aFilter['fullname'] . '%');
        }
        if (isset($aFilter['email'])) {
            $oUsers->where('email', 'like', '%' . $aFilter['email'] . '%');
        }
        if (isset($aFilter['federation'])) {
            $oUsers->whereHas('federation', function($query) use ($aFilter) {
                $query->where('name', 'like', '%' . $aFilter['federation'] . '%');
            });
        }
        if (isset($aFilter['local_union'])) {
            $oUsers->whereHas('localUnion', function($query) use ($aFilter) {
                $query->where('name', 'like', '%' . $aFilter['local_union'] . '%');
            });
        }
        if (isset($aFilter['role_id'])) {
            $oUsers->where('role_id', $aFilter['role_id']);
        }
        if (isset($aFilter['status_id'])) {
            $oUsers->where('status_id', $aFilter['status_id']);
        }
        return $this->getPaginatedRecords($oUsers);
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