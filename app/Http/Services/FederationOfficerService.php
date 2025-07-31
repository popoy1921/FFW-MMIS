<?php

namespace App\Http\Services;

use App\Mail\ConfirmEmailUpdate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as FormattedCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

use App\Models\FederationOfficer;

/**
 * Class that would handle any logic for Federation
 */
class FederationOfficerService extends BaseService
{    
    private Builder $oFederationOfficerModelBuilder;
    private string $sTable;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $aRelationShips = [
            'federation',
            'position',
            'localUnion',
            'gender',
        ];
        $this->oFederationOfficerModelBuilder = FederationOfficer::with($aRelationShips);
        $this->sTable = $this->oFederationOfficerModelBuilder->getModel()->getTable();
    }

    /**
     * create a record for the federation and return the created recordd
     * @param array $aFederationOfficer
     * 
     * @return FederationOfficer
     */
    public function createFederationOfficer(array $aFederationOfficer) : FederationOfficer
    {
        $oFederationOfficer = new FederationOfficer();
        $oFederationOfficer->name = $aFederationOfficer['name'];
        $oFederationOfficer->position_id = $aFederationOfficer['position_id'];
        $oFederationOfficer->federation_id = $aFederationOfficer['federation_id'];
        $oFederationOfficer->local_union_id = $aFederationOfficer['local_union_id'];
        $oFederationOfficer->gender_id = $aFederationOfficer['gender_id'];
        $oFederationOfficer->age = $aFederationOfficer['age'];
        $oFederationOfficer->save();
        
        return $oFederationOfficer;
    }
    
    /**
     * set Defaults to get the initial count
     *
     * @param  mixed $aInputs
     * @return void
     */
    public function setDefaults(array $aInputs) : void
    {
        if (isset($aInputs['default_federation_id'])) {
            $this->oFederationOfficerModelBuilder->where($this->sTable . '.' .'federation_id', '=', $aInputs['default_federation_id']);
        }
        $this->oFederationOfficerModelBuilder->where('deleted', '=', 0);
    }

    /**
     * get Count of current filter data
     *
     * @return int
     */
    public function getCount() : int
    {
        return $this->oFederationOfficerModelBuilder->count();
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
        $iNumberOfFilteredRecords = $this->oFederationOfficerModelBuilder->count();

        $iNumberOfRecords = (int)$aFilter['length'];
        $iPage = ((int)$aFilter['start'] / $iNumberOfRecords) + 1;
        $oFederationOfficerRecords = $this->getPaginatedRecords($this->oFederationOfficerModelBuilder, $iPage, $iNumberOfRecords);
        return array(
            'draw'            => intval($aFilter['draw']),                           // Return the draw counter
            'recordsFiltered' => $iNumberOfFilteredRecords,                          // Total records after filtering
            'data'            => $this->formatTableData($oFederationOfficerRecords), // Data for the current page
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
    
    /**
     * filter Data Query
     *
     * @param  array $aFilter
     * @return void
     */
    private function filterDataQuery(array $aFilter) : void
    {
        // Remove all empty string filters
        $aFilter = array_filter($aFilter, function($mValue) {
            if ($mValue === '') {
                return false;
            }
            if (is_array($mValue) === true && count($mValue) === 0) {
                return false;
            }
            return true;
        });

        // Add filters if it would add a search filter
    }

    private function sortDataQuery(array $aFilter) : void
    {
        $aColumns = [
            'name',
            'lu_federation_officer_positions.description.position_id',
            'local_unions.name.local_union_id',
            'lu_federation_officer_genders.description.gender_id',
            'age',
        ];
        $iIndexForLookup = 2;
        if (isset($aFilter['order']) === false) {
            $iColumnNumber = 0;
            $sColumn = $aColumns[0];
            $sAsc = 'asc';
        } else {
            $iColumnNumber = $aFilter['order'][0]['column'];
            $sColumn = $aColumns[$aFilter['order'][0]['column']];
            $sAsc = $aFilter['order'][0]['dir'];
        }

        if (count(explode('.', $aColumns[$iColumnNumber])) === 1) {
            $this->oFederationOfficerModelBuilder->orderBy($sColumn, $sAsc);
        } else {
            $sMainTableName = $this->oFederationOfficerModelBuilder->getModel()->getTable();
            $aColumnsValues = explode('.', $sColumn);
            $sForeignTableName = $aColumnsValues[0];        
            $sMainFieldId = $sMainTableName . '.' . $aColumnsValues[2];
            $sForiegnIdFieldName = $sForeignTableName . '.id';
            $this->oFederationOfficerModelBuilder->leftJoin($sForeignTableName, $sMainFieldId, '=', $sForiegnIdFieldName);
            $sFieldName = $aColumnsValues[0] . '.' . $aColumnsValues[1];
            $this->oFederationOfficerModelBuilder->orderByRaw($sFieldName . ' '.  $sAsc);
        }
    }
    
    /**
     * Update format of the users data for page rendering when using API
     *
     * @param  LengthAwarePaginator $oFederationOfficers
     * @return FormattedCollection
     */
    private function formatTableData(LengthAwarePaginator $oFederationOfficers) : FormattedCollection
    {
        $aFormattedFederationOfficers = $oFederationOfficers->map(function ($oFederationOfficer) {
            $sOfficerGuid = $oFederationOfficer->guid;
            $sOfficerDetailsLink = route('admin.federation-officer') . '?guid=' . $sOfficerGuid; 
            $sEditOfficerButton = '<a class="btn btn-sm btn-warning" title="View Details" href="'. $sOfficerDetailsLink .'"><i class="fa fa-search" aria-hidden="true"></i></a> ';
            $sRemoveOfficerButton = '<a class="btn btn-sm btn-danger remove-officer" title="Remove Officer" href="#" guid="' . $sOfficerGuid . '"><i class="fa fa-map" aria-hidden="true"></i></a> ';

            $sActions = $sEditOfficerButton . $sRemoveOfficerButton;
            return [
                'name'        => $oFederationOfficer->name,
                'position'    => $oFederationOfficer->position ? $oFederationOfficer->position->description : '',
                'local_union' => $oFederationOfficer->localUnion ? $oFederationOfficer->localUnion->name : '',
                'gender'      => $oFederationOfficer->gender ? $oFederationOfficer->gender->description : '',
                'age'         => $oFederationOfficer->age,
                'actions'     => $sActions,
            ];
        });
        return $aFormattedFederationOfficers;
    }

    /**
     * update Federation Officer
     *
     * @param  array $aFederation
     * @return Federation
     */
    public function updateFederationOfficer(array $aFederationOfficer) : FederationOfficer 
    {
        $oFederationOfficer = FederationOfficer::firstwhere('guid', $aFederationOfficer['guid']);
        $oFederationOfficer->update($aFederationOfficer);

        return $oFederationOfficer;
    }
}