<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    
    /**
    * table name in database
    *
    * @var string
    */
    protected $table = 'lu_regions';

    // Define the relationship to the IslandGroup model
    public function islandGroup()
    {
        return $this->belongsTo(IslandGroup::class, 'island_group_id');
    }
    
    // Define the relationship to the FederationOfficerPosition model
    public function localUnions()
    {
        return $this->hasMany(LocalUnion::class);
    }
}
