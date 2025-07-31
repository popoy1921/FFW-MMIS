<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FederationOfficerPosition extends Model
{
    use HasFactory;

    // Disable automatic timestamps
    public $timestamps = false;
    
    /**
    * table name in database
    *
    * @var string
    */
    protected $table = 'lu_federation_officer_positions';
}
