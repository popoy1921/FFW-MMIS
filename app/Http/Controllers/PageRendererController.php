<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Models\Federation;
use App\Models\FederationCategory;
use App\Models\FederationStatus;
use App\Models\Region;
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
    public function showCreateFederationpage() : View
    {
        $aPageDetails = array(
            'top_menu'              => 'trade_federations',
            'federationCategories'  => FederationCategory::orderBy('description', 'asc')->get(),
            'federationStatuses'    => FederationStatus::orderBy('id', 'desc')->get(),
        );
        return view('admin.create-federation', $aPageDetails);
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
        $aPageDetails = array(
            'userStatuses' => UserStatus::orderBy('id', 'desc')->get(),
            'userRoles'    => UserRole::where('id', '>=', 2)->get(),
            'top_menu'     => 'users',
            'filters'      => $oRequest->all(),
        );
        return view('admin.users', $aPageDetails);
    }

    /**
     * showAdminUserDetialsPage
     *
     * @return View
     */
    public function showAdminUserDetialsPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $aPageDetails = array(
            'user'         => User::with(['userRole', 'userStatus', 'federation', 'localUnion'])->where('guid', '=', $aData['guid'])->first(),
            'top_menu'     => 'users',
            'filters'      => $oRequest->all(),
        );
        return view('admin.user-details', $aPageDetails);
    }

    /**
     * showAdminFederationsPage
     *
     * @return View
     */
    public function showAdminTradeFederationsPage(Request $oRequest) : View
    {
        $aPageDetails = array(
            'top_menu'              => 'trade_federations',
            'federationCategories'  => FederationCategory::orderBy('description', 'asc')->get(),
            'federationStatuses'    => FederationStatus::orderBy('id', 'desc')->get(),
            'federations'           => Federation::orderBy('name', 'asc')->get(),
            'filters'               => $oRequest->all(),
        );
        return view('admin.trade-federations', $aPageDetails);
    }

    public function showAdminTradeFederationDetailsPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $oFederation = Federation::where('guid', '=', $aData['guid'])->first();
        $aPageDetails = array(
            'top_menu'              => 'trade_federations',
            'side_menu'             => 'details',
            'federation'            => $oFederation,
            'federationCategories'  => FederationCategory::orderBy('description', 'asc')->get(),
            'federationStatuses'    => FederationStatus::orderBy('id', 'desc')->get(),
        );
        if ((int)$oFederation->newly_created === 1) {
            $oFederationUpdate = Federation::where('guid', '=', $aData['guid'])->first();
            $oFederationUpdate->newly_created = 0;
            $oFederationUpdate->save();
        }
        return view('admin.trade-federation-details.details', $aPageDetails);
    }

    public function showAdminTradeFederationRegionDestributionsPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $aPageDetails = array(
            'top_menu'              => 'trade_federations',
            'side_menu'             => 'region_destributions',
            'federation'            => Federation::where('guid', '=', $aData['guid'])->first(),
        );
        return view('admin.trade-federation-details.region-destributions', $aPageDetails);
    }

    public function showAdminTradeFederationOfficersPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $aPageDetails = array(
            'top_menu'              => 'trade_federations',
            'side_menu'             => 'officers',
            'federation'            => Federation::where('guid', '=', $aData['guid'])->first(),
        );
        return view('admin.trade-federation-details.officers', $aPageDetails);
    }

    public function showAdminTradeFederationCBAProvisionsPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $aPageDetails = array(
            'top_menu'              => 'trade_federations',
            'side_menu'             => 'cba_provisions',
            'federation'            => Federation::where('guid', '=', $aData['guid'])->first(),
        );
        return view('admin.trade-federation-details.cba-provisions', $aPageDetails);
    }

    public function showAdminTradeFederationPointPersonsPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $aPageDetails = array(
            'top_menu'              => 'trade_federations',
            'side_menu'             => 'point_persons',
            'federation'            => Federation::where('guid', '=', $aData['guid'])->first(),
        );
        return view('admin.trade-federation-details.point_persons', $aPageDetails);
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
