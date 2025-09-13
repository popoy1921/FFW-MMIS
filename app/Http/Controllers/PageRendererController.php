<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Http\Services\UserService;
use App\Models\Federation;
use App\Models\FederationOfficer;
use App\Models\FederationOfficerPosition;
use App\Models\FederationOfficerGender;
use App\Models\FederationCategory;
use App\Models\FederationStatus;
use App\Models\LocalUnion;
use App\Models\ProvisionType;
use App\Models\Region;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserStatus;

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
    public function showSuperAdminBlankPage(Request $oRequest) : View
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
     * showSuperAdminBlankPage
     *
     * @return View
     */
    public function showAdminCreateFederationpage() : View
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
        $oFederation = Federation::where('guid', '=', $aData['guid'])->first();
        $aPageDetails = array(
            'top_menu'                      => 'trade_federations',
            'side_menu'                     => 'officers',
            'federation'                    => $oFederation,
        );
        return view('admin.trade-federation-details.officers', $aPageDetails);
    }

    public function showAdminCreateUpdateTradeFederationOfficerPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $bNew = false;
        if (isset($aData['federation_guid']) === true) {
            $sFormType = 'create';
            $sFormTitle = 'Add Officer';
            $oFederationOfficer = null;
            $sFederationGuid = $aData['federation_guid'];
            $sAction = route('admin.federation-officer.create');
        } else {
            $sFormType = 'update';
            $sFormTitle = 'Update Officer';
            $oFederationOfficer = FederationOfficer::where('guid', '=', $aData['guid'])->first();
            $sFederationGuid = $oFederationOfficer->federation->guid;
            $sAction = route('admin.federation-officer.update');
            if ((int)$oFederationOfficer->newly_created === 1) {
                $bNew = true;
                $oFederationUpdate = FederationOfficer::where('guid', '=', $aData['guid'])->first();
                $oFederationUpdate->newly_created = 0;
                $oFederationUpdate->save();
            }
        }
        $oFederation = Federation::where('guid', '=', $sFederationGuid)->first();
        $oLocalUnions = LocalUnion::where('federation_id', '=', $oFederation->id)->orderBy('name', 'desc')->get();
        $aPageDetails = array(
            'form_type'                     => $sFormType,
            'form_title'                    => $sFormTitle,
            'form_action'                   => $sAction,
            'newly_created'                 => $bNew,
            'federation_officer'            => $oFederationOfficer,    
            'federation_guid'               => $sFederationGuid,
            'top_menu'                      => 'trade_federations',
            'side_menu'                     => 'officers',
            'federation_officer_positions'  => FederationOfficerPosition::orderBy('description', 'asc')->get(),
            'federations'                   => Federation::orderBy('name', 'asc')->get(),
            'federation_id'                 => $oFederation->id,
            'local_unions'                  => $oLocalUnions,
            'federation_officer_genders'    => FederationOfficerGender::orderBy('description', 'asc')->get(),
        );
        return view('admin.trade-federation-details.officer', $aPageDetails);
    }

    public function showAdminTradeFederationCBAProvisionsPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $oFederation = Federation::where('guid', '=', $aData['guid'])->first();
        $aPageDetails = array(
            'top_menu'              => 'trade_federations',
            'side_menu'             => 'cba_provisions',
            'local_unions'          => LocalUnion::where('federation_id', '=', $oFederation->id)->get(),
            'provision_types'       => ProvisionType::get(),
            'federation'            => $oFederation,
        );
        return view('admin.trade-federation-details.cba-provisions', $aPageDetails);
    }

    public function showAdminTradeFederationPointPersonsPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $aPageDetails = array(
            'federation_guid'               => $aData['guid'],
            'top_menu'                      => 'trade_federations',
            'side_menu'                     => 'point_persons',
            'federation'                    => Federation::where('guid', '=', $aData['guid'])->first(),
            'userStatuses'                  => UserStatus::orderBy('id', 'desc')->get(),
            'is_list'                       => true,
        );
        return view('admin.trade-federation-details.point-persons', $aPageDetails);
    }

    public function showAdminTradeFederationPointPersonDetailPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $oUser = User::where('guid', '=', $aData['guid'])->first();
        $aPageDetails = array(
            'federation_guid'               => Federation::where('id', '=', $oUser->federation_id)->first()->guid,
            'top_menu'                      => 'trade_federations',
            'side_menu'                     => 'point_persons',
            'user'                          => $oUser,
            'federations'                   => Federation::orderBy('id', 'desc')->get(),
            'userStatuses'                  => UserStatus::orderBy('id', 'desc')->get(),
        );
        return view('admin.trade-federation-details.point-person', $aPageDetails);
    }

    public function showAdminCreateTradeFederationPointPersonPage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $aPageDetails = array(
            'federation_guid'               => $aData['guid'],
            'top_menu'                      => 'trade_federations',
            'side_menu'                     => 'point_persons',
            'federations'                   => Federation::orderBy('id', 'desc')->get(),
            'userStatuses'                  => UserStatus::orderBy('id', 'desc')->get(),
        );
        return view('admin.trade-federation-details.add-point-persons', $aPageDetails);
    }

    public function showAdminFinancePage(Request $oRequest) : View
    {
        $aData = $oRequest->all();
        $aPageDetails = array(
            'top_menu'      => 'finance',
            'federations'   => Federation::get(),
        );
        return view('admin.finance', $aPageDetails);
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
