<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdatePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $oUserService;
    
    /**
     * __construct
     *
     * @param  mixed $oUserRoleService
     * @return void
     */
    public function __construct(UserService $oUserService)
    {
        $this->oUserService = $oUserService;
    }
    
    /**
     * getList
     *
     * @param  mixed $oRequest
     * @return JsonResponse
     */
    public function getList(Request $oRequest) : JsonResponse
    {
        $aFilter = $oRequest->all();
        // if ((int)auth()->user()->role_id === 2) {
        //     $iRole = 2;
        // } else {
        //     $iRole = 0;
        // }
        $aFilter['role_limit'] = 2;
        return response()->json($this->oUserService->getFormattedTableData($aFilter));
    }
    
    /**
     * update User record
     *
     * @param  UserUpdateRequest $oRequest
     * @return RedirectResponse
     */
    public function updateUser(UserUpdateRequest $oRequest) : RedirectResponse
    {
        $oUser = $oRequest->all();
        $this->oUserService->update($oUser);
        
        session()->flash('user-update', 'Your profile has been successfully updated.');
        return redirect()->route('user.account-settings');
    }

    /**
     * update User record
     *
     * @param  UserUpdatePasswordRequest $oRequest
     * @return RedirectResponse
     */
    public function updateUserPassword(UserUpdatePasswordRequest $oRequest) : RedirectResponse
    {
        $aUpdatePassword = $oRequest->all();
        $aUpdatePassword['guid'] = auth()->user()->guid;
        $this->oUserService->updatePassword($aUpdatePassword);

        session()->flash('password-reset', 'Your password has been successfully updated.');
        return redirect()->route('user.account-settings');
    }
}
