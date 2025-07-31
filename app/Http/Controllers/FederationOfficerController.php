<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\FederationOfficerCreateUpdateRequest;
use App\Http\Services\FederationOfficerService;

class FederationOfficerController extends Controller
{
    private FederationOfficerService $oFederationOfficerService;
    
    /**
     * __construct
     *
     * @param  mixed $oUserRoleService
     * @return void
     */
    public function __construct(FederationOfficerService $oFederationOfficerService)
    {
        $this->oFederationOfficerService = $oFederationOfficerService;
    }

    /**
     * create Federation Officer record
     * @param Request $oRequest
     * 
     * @return JsonResponse
     */
    public function createFederationOfficer(FederationOfficerCreateUpdateRequest $oRequest) : JsonResponse
    {
        $aFederationOfficerDetail = $oRequest->all(); 
        $oFederationOfficer = $this->oFederationOfficerService->createFederationOfficer($aFederationOfficerDetail);
        return response()->json(array('guid' => $oFederationOfficer->guid));
    }

    /**
     * get list of available Federation Officers
     * @param Request $oRequest
     * 
     * @return JsonResponse
     */
    public function getList(Request $oRequest) : JsonResponse
    {
        $aFilter = $oRequest->all();
        $this->oFederationOfficerService->setDefaults($aFilter);
        $iUnfiltertedCount = $this->oFederationOfficerService->getCount();
        $aFederationOfficerList = $this->oFederationOfficerService->getFormattedTableData($aFilter);
        $aFederationOfficerList['recordsTotal'] = $iUnfiltertedCount;
        return response()->json($aFederationOfficerList);
    }

    /**
     * update Federation Officer record
     * @param Request $oRequest
     * 
     * @return JsonResponse
     */
    public function updateFederationOfficer (Request $oRequest) : JsonResponse
    {
        $aFederationOfficerDetails = $oRequest->all();
        $oFederationOfficer = $this->oFederationOfficerService->updateFederationOfficer($aFederationOfficerDetails);

        return response()->json(array('guid' => $oFederationOfficer->guid));;
    }
}
