<?php

namespace App\Http\Services;

use App\Models\Region;
use Illuminate\Support\Collection as FormattedCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class that would handle any logic for Regions Distribution
 */
class RegionalDistributionService extends BaseService
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $aRelationShips = [
            'islandGroup',
            'localUnions',
        ];
        $this->oModelBuilder = Region::with($aRelationShips);
    }
    
    /**
     * set Defaults to get the initial count
     *
     * @param  mixed $aInputs
     * @return void
     */
    public function setDefaults(array $aInputs) : void
    {
        if (isset($aInputs['default_federation'])) {
            $this->oModelBuilder->whereHas('localUnions', function($query) use ($aInputs) {
                $query->where('federation_id', (int) $aInputs['default_federation']);
            });
        }
    }

    /**
     * get Count of current filter data
     *
     * @return int
     */
    public function getCount() : int
    {
        return $this->oModelBuilder->count();
    }

    /**
     * getFormattedTableData
     *
     * @param  mixed $aFilter
     * @return array
     */
    public function getFormattedTableData(array $aFilter) : array
    {
        $this->setUserModelQueries($aFilter);
        $iNumberOfFilteredRecords = $this->getCount();

        $iNumberOfRecords = (int)$aFilter['length'];
        $iPage = ((int)$aFilter['start'] / $iNumberOfRecords) + 1;
        $oRegionalDistributionRecords = $this->getPaginatedRecords($this->oModelBuilder, $iPage, $iNumberOfRecords);

        return array(
            'draw'            => intval($aFilter['draw']),              // Return the draw counter
            'data'            => $this->formatTableData($oRegionalDistributionRecords, $aFilter), // Data for the current page
        );
    }

    /**
     * prepare model for get and count of filtered
     *
     * @param  array $aFilter
     * @return void
     */
    public function setUserModelQueries(array $aFilter) : void
    {
        $this->filterDataQuery($aFilter);
        $this->sortDataQuery($aFilter);
    }

    private function filterDataQuery(array $aFilter) : void
    {
    }

    private function sortDataQuery(array $aFilter) : void
    {
        $aColumns = [
            'lu_island_groups.island_description.island_group_id',
            'id',
        ];
        
        $iColumnNumber = 0;
        $sDirection = 'asc';

        // Perform sorting
        if (isset($aFilter['order']) === true) {
            $iColumnNumber = $aFilter['order'][0]['column'];
            $sDirection = $aFilter['order'][0]['dir'];
        }
        $sColumn = $aColumns[$iColumnNumber];
        $aColumns = explode('.', $sColumn);
        if (count($aColumns) === 1) {
            $this->oModelBuilder->orderBy($sColumn, $sDirection);
        } else {
            $this->performSortFromOtherTable($aColumns, $sDirection);
        }
    }
    
    /**
     * Update format of the users data for page rendering when using API
     *
     * @param  mixed $oRegionalDistributions
     * @param  array $aFilter
     * @return FormattedCollection
     */
    private function formatTableData(LengthAwarePaginator $oRegionalDistributions, array $aFilter) : FormattedCollection
    {
        $oNewRegionalDistributions = collect([]);
        $oRegionalDistributions->map(function ($oRegionalDistribution) use ($oNewRegionalDistributions, $aFilter) {
            $oFilteredLocalUnions = $oRegionalDistribution->localUnions->filter(function ($oLocalUnion) use ($aFilter) {
                return $oLocalUnion->federation_id === $aFilter['default_federation'];
            });

            $oNewRegionalDistributions->push(array(
                'island_group_description'  => $oRegionalDistribution->islandGroup->island_description,
                'region_description'        => $oRegionalDistribution->region_description,
                'number_of_local_unions'    => count($oFilteredLocalUnions),
            ));
        });
        return $oNewRegionalDistributions;
    }
}