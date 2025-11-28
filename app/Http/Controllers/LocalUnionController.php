<?php

namespace App\Http\Controllers;

use App\Http\Services\LocalUnionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Services\FederationService;

class LocalUnionController extends Controller
{
    private LocalUnionService $oLocalUnionService;
    
    /**
     * __construct
     *
     * @param  mixed $oUserRoleService
     * @return void
     */
    public function __construct(LocalUnionService $oLocalUnionService)
    {
        $this->oLocalUnionService = $oLocalUnionService;
    }
    
    /**
     * get list of available Federations
     * @param Request $oRequest
     * 
     * @return JsonResponse
     */
    public function getList(Request $oRequest) : JsonResponse
    {
        $aFilters = $oRequest->all();
        return response()->json($this->oLocalUnionService->getList($aFilters));
    }

}
