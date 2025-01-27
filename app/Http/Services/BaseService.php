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
    private LengthAwarePaginator $oRecords;

    /**
     * get records of 
     *
     * @return LengthAwarePaginator
     */
    public function getPaginatedRecords(Builder $oBuilder, int $iPage, int $iNumberOfRecords) : LengthAwarePaginator
    {
        return $oBuilder->paginate($iNumberOfRecords, ['*'], 'page', $iPage);;
    }

    /**
     * @param LengthAwarePaginator $oRecords
     * 
     * @return array
     */
    public function getPaginationDetails(LengthAwarePaginator $oRecords) : array
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
}

