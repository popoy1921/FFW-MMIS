<?php

namespace App\Http\Services;

use App\Mail\ConfirmEmailUpdate;
use App\Models\Federation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as FormattedCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class that would handle any logic for Federation
 */
class FederationService extends BaseService
{    
    private Builder $oFederationModelBuilder;

    /**
     * create a record for the federation and return the created recordd
     * @param array $aFederation
     * 
     * @return Federation
     */
    public function createFederation(array $aFederation) : Federation
    {
        $oFederation = new Federation();
        $oFederation->name = $aFederation['name'];
        $oFederation->category_id = $aFederation['category_id'];
        $oFederation->status_id = $aFederation['status_id'];
        $oFederation->save();
        
        return $oFederation;
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
        $iNumberOfFilteredRecords = $this->oFederationModelBuilder->count();

        $iNumberOfRecords = (int)$aFilter['length'];
        $iPage = ((int)$aFilter['start'] / $iNumberOfRecords) + 1;
        $oFederationRecords = $this->getPaginatedRecords($this->oFederationModelBuilder, $iPage, $iNumberOfRecords);
        return array(
            'draw'            => intval($aFilter['draw']),                    // Return the draw counter
            'recordsTotal'    => Federation::count(),                         // Total records without filtering
            'recordsFiltered' => $iNumberOfFilteredRecords,                   // Total records after filtering
            'data'            => $this->formatTableData($oFederationRecords), // Data for the current page
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
        $aRelationShips = [
            'federationCategory',
            'localUnions',
            'federationStatus',
        ];
        $this->oFederationModelBuilder = Federation::with($aRelationShips)->select('federations.*');
        $this->filterDataQuery($aFilter);
        $this->sortDataQuery($aFilter);
        return;
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

        if (isset($aFilter['category_id'])) {
            $this->oFederationModelBuilder->where('category_id', '=', $aFilter['category_id']);
        }
        if (isset($aFilter['id'])) {
            $this->oFederationModelBuilder->where('federations.id', '=', $aFilter['id']);
        }
        if (isset($aFilter['status_id'])) {
            $this->oFederationModelBuilder->where('status_id', '=', $aFilter['status_id']);
        }
    }

    /**
     * prepare statement for sorting
     * @param array $aFilter
     * 
     * @return void
     */
    private function sortDataQuery(array $aFilter) : void
    {
        // tablename.field_on_foreign_table_for_sort.field_in_main_table
        $aColumns = [
            'lu_federation_categories.description.category_id',
            'name',
            '', // skip "Total Number of Local Unions"
            'lu_federation_statuses.description.status_id',
        ];

        $iColumnNumber = 0;
        $sDirection = 'asc';

        // Default sorting OR Sort Category, Name
        if (isset($aFilter['order']) === false || (int)$aFilter['order'][0]['column'] === 0) {
            if (isset($aFilter['order']) === true) {
                $sDirection = $aFilter['order'][0]['dir'];
            }
            $this->performSortFromOtherTable(explode('.', $aColumns[0]), $sDirection);
            $this->oFederationModelBuilder->orderBy('name', 'asc');
            return;
        }

        // Perform sorting
        $this->performSortFromOtherTable(explode('.', $aColumns[0]), $sDirection);
        if (isset($aFilter['order']) === true) {
            $iColumnNumber = $aFilter['order'][0]['column'];
            $sColumn = $aColumns[$iColumnNumber];
            $sDirection = $aFilter['order'][0]['dir'];
        }
        
        $aColumns = explode('.', $sColumn);
        if (count($aColumns) === 1) {
            $this->oFederationModelBuilder->orderBy($sColumn, $sDirection);
        } else {
            $this->performSortFromOtherTable($aColumns, $sDirection);
        }
    }
    
    /**
     * perform Sort From Other Table
     *
     * @param  array $aColumns
     * @param  string $sDirection
     * @return void
     */
    public function performSortFromOtherTable(array $aColumns, string $sDirection)
    {
        $sUserTableName = $this->oFederationModelBuilder->getModel()->getTable();
        $aColumnsValues = $aColumns;
        $sTableName = $aColumnsValues[0];        
        $sUserFieldId = $sUserTableName . '.' . $aColumnsValues[2];
        $sForiegnIdFieldName = $sTableName . '.id';
        $sFieldName = $aColumnsValues[0] . '.' . $aColumnsValues[1];
        if ($this->isJoined($this->oFederationModelBuilder, $sTableName) === false) {
            $this->oFederationModelBuilder->leftJoin($sTableName, $sUserFieldId, '=', $sForiegnIdFieldName);
        }
        $this->oFederationModelBuilder->orderByRaw($sFieldName . ' '.  $sDirection);
    }
    
    /**
     * Update format of the users data for page rendering when using API
     *
     * @param  LengthAwarePaginator $oFederation
     * @return array
     */
    private function formatTableData(LengthAwarePaginator $oFederations) : array
    {
        $aFormattedFederations = array();
        $sCurrentCategory = '';
        foreach ($oFederations as $oFederation) {
            $sFederationNameOnloop = $oFederation->federationCategory->description;
            if ($sCurrentCategory !== $sFederationNameOnloop) {
                $sCurrentCategory = $sFederationNameOnloop;
                $iIndex = count($aFormattedFederations);
                $aFormattedFederations[$iIndex]['federation_category'] = $sFederationNameOnloop;
                $aFormattedFederations[$iIndex]['records']      = array();
                $aFormattedFederations[$iIndex]['name']         = '';
                $aFormattedFederations[$iIndex]['local_unions'] = '';
                $aFormattedFederations[$iIndex]['status']       = '';
                $aFormattedFederations[$iIndex]['actions']      = '';
            }

            // Child Records
            $sViewDetailsButton = '<a class="btn btn-sm btn-primary" title="View Details" href="' . route('admin.trade-federation-details'). '?guid=' . $oFederation->guid .'"><i class="fa fa-search" aria-hidden="true"></i></a> ';
            if ((int)$oFederation->status_id === 1) {
                $sUpdateStatusButton = '<a class="btn btn-sm btn-success update-status deactivate" title="Update Status" href="#" guid="'. $oFederation->guid .'">'
                . '<i class="fa fa-pencil" aria-hidden="true"></i>'
                . '</a> ';
            } else {
                $sUpdateStatusButton = '<a class="btn btn-sm btn-success update-status activate" title="Update Status" href="#" guid="'. $oFederation->guid .'">'
                . '<i class="fa fa-pencil" aria-hidden="true"></i>'
                . '</a> ';
            }
            $sViewRegionDistributionButton = '<a class="btn btn-sm btn-warning" title="View Region Distribution" href="#"><i class="fa fa-map" aria-hidden="true"></i></a> ';
            $aFederationRecord = array(
                'federation_category'   => $oFederation->federationCategory->description,
                'name'                  => $oFederation->name,
                'local_unions'          => count($oFederation->localUnions),
                'status'                => $oFederation->federationStatus->description,
                'actions'               => $sViewDetailsButton . $sUpdateStatusButton . $sViewRegionDistributionButton,
            );
            array_push($aFormattedFederations[$iIndex]['records'], $aFederationRecord);
        }
        
        return $aFormattedFederations;
    }

    /**
     * update Status
     *
     * @param  array $aFederation
     * @return Federation
     */
    public function updateStatus(array $aFederation) : Federation 
    {
        $oFederation = Federation::firstwhere('guid', $aFederation['guid']);
        $oFederation->status_id = $aFederation['status_id'];
        $oFederation->save();

        return $oFederation;
    }

    /**
     * update Status
     *
     * @param  array $aFederation
     * @return Federation
     */
    public function updateDetails(array $aFederation) : Federation 
    {
        $oFederation = Federation::firstwhere('guid', $aFederation['guid']);
        $oFederation->name = $aFederation['name'];
        $oFederation->status_id = $aFederation['status_id'];
        $oFederation->category_id = $aFederation['category_id'];
        $oFederation->save();

        return $oFederation;
    }
}