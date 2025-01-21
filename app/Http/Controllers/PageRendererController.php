<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageRendererController extends Controller
{
    private UserService $oUserService;
    
    public function __construct(UserService $UoserService)
    {
        $this->oUserService = $UoserService;
    }

    // ------------------- GUEST -------------------
    /**
     * showUnionProfilePage
     *
     * @return View
     */
    public function showForgotPasswordPage() : View
    {
        return view('guest.forgot-password');
    }

    // ------------------- USER -------------------
    /**
     * showUnionProfilePage
     *
     * @return View
     */
    public function showAccountSettingsPage() : View
    {
        $oUser = $this->oUserService->getUsersProfileData();
        $aPageDetails = array(
            'top_menu'  => 'account_settings',
            'role'      => $oUser->userRole->description,
            'guid'      => auth()->user()->guid,
        );
        return view('user.account-settings', $aPageDetails);
    }

    // ------------------- SUPER-ADMIN -------------------
    /**
     * showSuperAdminBlankPage
     *
     * @return View
     */
    public function showSuperAdminBlankPage() : View
    {
        $aPageDetails = array(
            'top_menu'  => 'users',
        );
        return view('super-admin.users', $aPageDetails);
    }
    
    // ------------------- ADMIN -------------------
    /**
     * showAdminLocalUnionsPage
     *
     * @return View
     */
    public function showAdminLocalUnionsPage() : View
    {
        $aPageDetails = array(
            'top_menu' => 'local_union',
        );
        return view('admin.local-unions', $aPageDetails);
    }

    /**
     * showAdminUsersPage
     *
     * @return View
     */
    public function showAdminUsersPage(Request $oRequest) : View
    {
        $oUsers = $this->oUserService->getUsersTableData($oRequest->all());
        $aPageDetails = array(
            'users'        => $oUsers,
            'pagination'   => $this->oUserService->getPaginationDetails($oUsers),
            'userStatuses' => UserStatus::orderBy('id', 'desc')->get(),
            'userRoles'    => UserRole::all(),
            'top_menu'     => 'users',
            'filters'      => $oRequest->all(),
        );
        return view('admin.users', $aPageDetails);
    }
    
    // ------------------- FEDERATION-POINT-PERSON -------------------
    /**
     * showFederationProfilePage
     *
     * @return View
     */
    public function showFederationProfilePage() : View
    {
        $aPageDetails = array(
            'top_menu' => 'trade_federation',
        );
        return view('federation-point-person.federation-profile', $aPageDetails);
    }

    // ------------------- UNION-POINT-PERSON -------------------
    /**
     * showUnionProfilePage
     *
     * @return View
     */
    public function showUnionProfilePage() : View
    {
        $aPageDetails = array(
            'top_menu'  => 'local_union',
            'page'      => 'union_profile',
        );
        return view('union-point-person.union-profile', $aPageDetails);
    }
}
