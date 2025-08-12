<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Services\ProvisionService;

class ProvisionController extends Controller
{
    private ProvisionService $oProvisionService;
    
    /**
     * __construct
     *
     * @param  FederationService $oFederationService
     * @return void
     */
    public function __construct(ProvisionService $oProvisionService)
    {
        $this->oProvisionService = $oProvisionService;
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
        $this->oProvisionService->setDefaults($aFilter);
        $iUnfiltertedCount = $this->oProvisionService->getCount();
        $aRegionalDistributionList = $this->oProvisionService->getFormattedTableData($aFilter);
        $aRegionalDistributionList['recordsTotal'] = $iUnfiltertedCount;
        return response()->json($aRegionalDistributionList);
    }
}
