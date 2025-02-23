<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalUnion extends Model
{
    use HasFactory;
    
    /**
    * table name in database
    *
    * @var string
    */
    protected $table = 'local_unions';

    // Define the relationship to the Federation model
    public function federation()
    {
        return $this->belongsTo(Federation::class, 'federation_id');
    }

    // Define the relationship to the LocalUnion model
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
