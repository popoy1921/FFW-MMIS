<?php

namespace App\Http\Controllers;

use App\Http\Services\FederationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    public function getList(Request $oRequest)
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
