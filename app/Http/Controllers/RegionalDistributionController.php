<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Services\RegionalDistributionService;

class RegionalDistributionController extends Controller
{
    private RegionalDistributionService $RegionalDistributionService;
    
    /**
     * __construct
     *
     * @param  FederationService $oFederationService
     * @return void
     */
    public function __construct(RegionalDistributionService $RegionalDistributionService)
    {
        $this->RegionalDistributionService = $RegionalDistributionService;
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
        $this->RegionalDistributionService->setDefaults($aFilter);
        $iUnfiltertedCount = $this->RegionalDistributionService->getCount();
        $aRegionalDistributionList = $this->RegionalDistributionService->getFormattedTableData($aFilter);
        $aRegionalDistributionList['recordsTotal'] = $iUnfiltertedCount;
        return response()->json($aRegionalDistributionList);
    }
}
