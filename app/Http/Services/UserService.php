<?php

namespace App\Http\Services;

use App\Mail\ConfirmEmailUpdate;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class that would handle any logic for User Role
 */
class UserService
{        
    /**
     * update the user record specifically name fields and sending email update confirmation 
     *
     * @return void
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