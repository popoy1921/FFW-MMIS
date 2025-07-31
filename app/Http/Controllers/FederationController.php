<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Services\FederationService;

class FederationController extends Controller
{
    private FederationService $oFederationService;
    
    /**
     * __construct
     *
     * @param  mixed $oUserRoleService
     * @return void
     */
    public function __construct(FederationService $oFederationService)
    {
        $this->oFederationService = $oFederationService;
    }

    /**
     * create Federation record
     * @param Request $oRequest
     * 
     * @return JsonResponse
     */
    public function createFederation(Request $oRequest) : JsonResponse
    {
        $aFederation = $oRequest->all();
        $oCreatedFederation = $this->oFederationService->createFederation($aFederation);
        return response()->json($oCreatedFederation);
    }

    /**
     * get list of available Federations
     * @param Request $oRequest
     * 
     * @return JsonResponse
     */
    public function getList(Request $oRequest) : JsonResponse
    {
        $aFilter = $oRequest->all();
        return response()->json($this->oFederationService->getFormattedTableData($aFilter));
    }

    /**
     * update federation record status
     *
     * @param  UserUpdateRequest $oRequest
     * @return RedirectResponse
     */
    public function updateStatus(Request $oRequest) : RedirectResponse
    {
        $aFederation = $oRequest->all();
        $oFederation = $this->oFederationService->updateStatus($aFederation);
        $sProcess = (int)$aFederation['status_id'] === 0 ? 'deactivated' : 'activated';

        // session()->flash('federation-updatStatus', $oFederation->name . ' has been successfully ' . $sProcess . '.');
        session()->flash('federation-update-status', 'Trade Federation status updated successfully!');
        return redirect()->route('admin.trade-federations');
    }

    public function updateFederation(Request $oRequest) : RedirectResponse
    {
        $aUpdateDetails = $oRequest->all();
        $this->oFederationService->updateDetails($aUpdateDetails);

        session()->flash('federation-update', 'Trade Federation details updated successfully!');
        return redirect()->back();
    }
}
