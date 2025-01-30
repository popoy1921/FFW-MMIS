<?php

namespace App\Http\Controllers;

use App\Http\Services\FederationService;
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
}
