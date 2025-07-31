<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FederationOfficerGender extends Model
{
    use HasFactory;

    // Disable automatic timestamps
    public $timestamps = false;
    
    /**
    * table name in database
    *
    * @var string
    */
    protected $table = 'lu_federation_officer_genders';
}
