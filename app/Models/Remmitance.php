<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remmitance extends Model
{
    use HasFactory;
    
    /**
    * table name in database
    *
    * @var string
    */
    protected $table = 'remmitance';

    // Define the relationship to the IslandGroup model
    public function localUnion()
    {
        return $this->belongsTo(LocalUnion::class, 'local_union_id');
    }
}
