<?php

namespace App\Http\Services;

use App\Models\Provision;
use Illuminate\Support\Collection as FormattedCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class that would handle any logic for Regions Distribution
 */
class ProvisionService extends BaseService
{
    private array $aRelationShips = [
            'localUnion',
            'provisionType',
    ];

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->oModelBuilder = Provision::with($this->aRelationShips);
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
            $this->oModelBuilder->whereHas('localUnion', function($query) use ($aInputs) {
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
        $oProvisionRecords = $this->getPaginatedRecords($this->oModelBuilder, $iPage, $iNumberOfRecords);

        return array(
            'draw'            => intval($aFilter['draw']),                              // Return the draw counter
            'recordsFiltered' => $iNumberOfFilteredRecords,             // Total records after filtering
            'data'            => $this->formatTableData($oProvisionRecords, $aFilter),  // Data for the current page
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
        if (isset($aFilter['local_union_id'])) {
            $this->oModelBuilder = Provision::with($this->aRelationShips);
            $this->oModelBuilder->whereHas('localUnion', function($query) use ($aFilter) {
                $query->where('federation_id', (int)$aFilter['default_federation']);
                $query->where('id' , (int)$aFilter['local_union_id']);
            });
        }
        if (isset($aFilter['provision_type_id'])) {
            $this->oModelBuilder->whereHas('provisionType', function($query) use ($aFilter) {
                $query->where('id', $aFilter['provision_type_id']);
            });
        }
    }

    private function sortDataQuery(array $aFilter) : void
    {
        $aColumns = [
            'local_unions.name.local_union_id',
            'lu_provision_types.description.provision_type_id',
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
     * @param  mixed $oProvisions
     * @param  array $aFilter
     * @return FormattedCollection
     */
    private function formatTableData(LengthAwarePaginator $oProvisions, array $aFilter) : FormattedCollection
    {
        $aFormattedProvisions = $oProvisions->map(function ($oProvision) {
            return [
                'local_union'               => $oProvision->localUnion->name,
                'category'                  => $oProvision->provisionType->description,
                'provision'                 => $oProvision->description,
            ];
        });
        return $aFormattedProvisions;
    }
}