<?php

namespace App\Http\Controllers;

use App\Http\Services\UserRoleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRoleService $oUserRoleService;
    
    /**
     * __construct
     *
     * @param  mixed $oUserRoleService
     * @return void
     */
    public function __construct(UserRoleService $oUserRoleService)
    {
        $this->oUserRoleService = $oUserRoleService;
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
        $aUserRoles = $this->oUserRoleService->getAll();
        $aPageDetails = array(
            'role' => $aUserRoles->firstwhere('id', auth()->user()->role_id)->description,
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
        return view('super-admin.users');
    }
    
    // ------------------- ADMIN -------------------
    /**
     * showAdminBlankPage
     *
     * @return View
     */
    public function showAdminBlankPage() : View
    {
        $aPageDetails = array(
            'top_menu' => 'local_union',
        );
        return view('admin.local-unions', $aPageDetails);
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
        return view('union-point-person.union-profile', array('page' => 'union_profile'));
    }
}
