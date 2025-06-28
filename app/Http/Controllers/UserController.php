<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdatePasswordRequest;
use App\Http\Requests\UserCreateUpdateRequest;
use App\Http\Services\UserService;
use App\Models\Federation;
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
     * getUserDetails used for API
     *
     * @param  Request $oRequest
     * @return JsonResponse
     */
    public function getUserDetails(Request $oRequest) : JsonResponse
    {
        return response()->json($this->oUserService->getUsersDetails($oRequest->all()['guid']));
    }
    
    /**
     * getList used for API
     *
     * @param  mixed $oRequest
     * @return JsonResponse
     */
    public function getList(Request $oRequest) : JsonResponse
    {
        $aFilter = $oRequest->all();
        $aFilter['role_limit'] = 2;
        $this->oUserService->setDefaults($aFilter);
        unset($aFilter['table']);
        $iUnfiltertedCount = $this->oUserService->getCount();
        $aUserList = $this->oUserService->getFormattedTableData($aFilter);
        $aUserList['recordsTotal'] = $iUnfiltertedCount;
        return response()->json($aUserList);
    }
    
    /**
     * create User record
     *
     * @param  UserCreateUpdateRequest $oRequest
     * @return JsonResponse
     */
    public function createUser(UserCreateUpdateRequest $oRequest) : JsonResponse
    {
        $oUser = $oRequest->all();
        $oUser['federation_id'] = (Federation::where('guid', '=', $oUser['federation_guid'])->first())->id;
        unset($oUser['federation_guid']);
        return response()->json($this->oUserService->createUpdate($oUser));
    }
    
    /**
     * update User record
     *
     * @param  UserCreateUpdateRequest $oRequest
     * @return RedirectResponse
     */
    public function updateUser(UserCreateUpdateRequest $oRequest) : RedirectResponse
    {
        $oUser = $oRequest->all();
        $this->oUserService->createUpdate($oUser);
        
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

    /**
     * update user status
     *
     * @param  Request $oRequest
     * @return bool
     */
    public function updateStatus(Request $oRequest) : bool
    {
        $aUser = $oRequest->all();
        return $this->oUserService->updateStatus($aUser);;
    }
}
