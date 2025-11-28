<?php

namespace App\Http\Services;

use App\Models\LocalUnion;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class that would handle any logic for Regions Distribution
 */
class LocalUnionService extends BaseService
{
    private array $aRelationShips = [
        'federation',
        'region',
    ];

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->oModelBuilder = LocalUnion::with($this->aRelationShips);
    }

    /**
     * get Count of current filter data
     *
     * @return Collection
     */
    public function getList(array $aFilter) : Collection
    {
        $iFederationId = $aFilter['federation_id'];
        return LocalUnion::where('federation_id', $iFederationId)->get();
    }
}