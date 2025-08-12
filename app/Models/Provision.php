<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provision extends Model
{
    use HasFactory;
    
    /**
    * table name in database
    *
    * @var string
    */
    protected $table = 'provisions';

    // Define the relationship to the ProvisionType model
    public function provisionType()
    {
        return $this->belongsTo(ProvisionType::class, 'provision_type_id');
    }
    
    // Define the relationship to the LocalUnion model
    public function localUnion()
    {
        return $this->belongsTo(LocalUnion::class, 'local_union_id');
    }
}
