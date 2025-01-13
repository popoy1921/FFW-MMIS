<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageRendererController extends Controller
{
    // ------------------- UNION-POINT-PERSON -------------------
    /**
     * showUnionProfilePage
     *
     * @return View
     */
    public function showForgotPasswordPage() : View
    {
        return view('guest.forgot-password');
    }

    // ------------------- SUPER-ADMIN -------------------
    /**
     * showSuperAdminBlankPage
     *
     * @return View
     */
    public function showSuperAdminBlankPage() : View
    {
        return view('super-admin.blank');
    }
    
    // ------------------- ADMIN -------------------
    /**
     * showAdminBlankPage
     *
     * @return View
     */
    public function showAdminBlankPage() : View
    {
        return view('admin.blank');
    }
    
    // ------------------- FEDERATION-POINT-PERSON -------------------
    /**
     * showFederationProfilePage
     *
     * @return View
     */
    public function showFederationProfilePage() : View
    {
        return view('federation-point-person.federation-profile', array('page' => 'federation_profile'));
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
