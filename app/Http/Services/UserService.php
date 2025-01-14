<?php

namespace App\Http\Services;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class that would handle any logic for User Role
 */
class UserRoleService
{        
    /**
     * get records of 
     *
     * @return Collection
     */
    public function update() : Collection
    {
        return UserRole::all();
    }
}