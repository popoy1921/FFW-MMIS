<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FederationOfficer extends Model
{
    use HasFactory;

    // Disable automatic timestamps
    public $timestamps = false;
    
    /**
    * table name in database
    *
    * @var string
    */
    protected $table = 'federation_officers';

    protected $fillable = [
        'name',
        'position_id',
        'federation_id',
        'local_union_id',
        'gender_id',
        'age',
        'deleted',
    ];

    // Define the relationship to the FederationOfficerPosition model
    public function position()
    {
        return $this->belongsTo(FederationOfficerPosition::class, 'position_id');
    }

    // Define the relationship to the Federation model
    public function federation()
    {
        return $this->belongsTo(Federation::class, 'federation_id');
    }

    // Define the relationship to the LocalUnion model
    public function localUnion()
    {
        return $this->belongsTo(LocalUnion::class, 'local_union_id');
    }

    // Define the relationship to the FederationOfficerGender model
    public function gender()
    {
        return $this->belongsTo(FederationOfficerGender::class, 'gender_id');
    }


    // Automatically generate a UUID when creating a new instance
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string) Str::uuid();
        });
    }
}
