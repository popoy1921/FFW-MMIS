<?php

namespace App\Http\Controllers;

use App\Http\Services\UserRoleService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageRendererController extends Controller
{
    private UserRoleService $oUserRoleService;

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
        $oUser = User::with('userRole')->where('guid', auth()->user()->guid)->first();
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
            'top_menu' => '',
        );
        return view('super-admin.users', $aPageDetails);
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
        $aPageDetails = array(
            'top_menu' => '',
            'page' => 'union_profile'
        );
        return view('union-point-person.union-profile', $aPageDetails);
    }
}
