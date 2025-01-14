<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageRendererController extends Controller
{
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
