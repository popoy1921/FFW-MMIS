<?php

namespace App\Http\Services;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class that would handle any logic for User Role
 */
class BaseService
{
    /**
     * Current records
     * @var LengthAwarePaginator
     */
    protected LengthAwarePaginator $oRecords;

    /**
     * Current records
     * @var LengthAwarePaginator
     */
    protected Builder $oModelBuilder;

    /**
     * get records of 
     *
     * @return LengthAwarePaginator
     */
    protected function getPaginatedRecords(Builder $oBuilder, int $iPage, int $iNumberOfRecords) : LengthAwarePaginator
    {
        return $oBuilder->paginate($iNumberOfRecords, ['*'], 'page', $iPage);;
    }

    /**
     * @param LengthAwarePaginator $oRecords
     * 
     * @return array
     */
    protected function getPaginationDetails(LengthAwarePaginator $oRecords) : array
    {
        $iCurrentPage = $oRecords->currentPage();
        $iLastPage = $oRecords->lastPage();
        $iPaginationFirstPage = $iCurrentPage > 3 ? $iCurrentPage - 2 : 1;
        $iPaginationLastPage = $iCurrentPage + 2 > $iLastPage ? $iLastPage : $iCurrentPage + 2;
        return array(
            'first_page'   => $iPaginationFirstPage,
            'last_page'    => $iPaginationLastPage,
            'is_last_max'  => $iPaginationLastPage === $iLastPage,
            'is_first_min' => $iPaginationFirstPage === 1,
            'current_page' => $iCurrentPage,
        );
    }

    /**
     * perform Sort From Other Table
     *
     * @param  array $aColumns           ''
     * @param  string $sDirection
     * @return void
     */
    public function performSortFromOtherTable(array $aColumns, string $sDirection)
    {
        $sCurrentTableName = $this->oModelBuilder->getModel()->getTable();
        $aColumnsValues = $aColumns;
        $sForeignTableName = $aColumnsValues[0];        
        $sCurrentTableField = $sCurrentTableName . '.' . $aColumnsValues[2];
        $sForiegnIdField = $sForeignTableName . '.id';
        $sSortingFieldName = $aColumnsValues[0] . '.' . $aColumnsValues[1];

        $this->oModelBuilder->join($sForeignTableName, $sForiegnIdField, '=', $sCurrentTableField);
        $this->oModelBuilder->orderBy($sSortingFieldName, $sDirection);
        dump($this->oModelBuilder->toSql());
    }
    
    /**
     * is Joined
     *
     * @param  Builder $oBuilder
     * @param  string  $sTable
     * @return bool
     */
    public static function isJoined(Builder $oBuilder, string $sTable) : bool
    {  
        $aJoins = $oBuilder->getQuery()->joins;  
        if ($aJoins === null) {  
            return false;  
        }  

        foreach ($aJoins as $join) {  
            if ($join->table === $sTable) {  
                return true;  
            }  
        }  

        return false;  
    }
}

