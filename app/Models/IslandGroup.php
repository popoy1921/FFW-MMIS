<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IslandGroup extends Model
{
    use HasFactory;
    
    /**
    * table name in database
    *
    * @var string
    */
    protected $table = 'lu_island_groups';

    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
