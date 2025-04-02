<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Federation extends Model
{
    use HasFactory;

    // Disable automatic timestamps
    public $timestamps = false;
    
    /**
    * table name in database
    *
    * @var string
    */
    protected $table = 'federations';

    protected $fillable = [
        'name',
        'category_id',
        'status_id',
        'newly_created'
    ];

    // Define the relationship to the FederationCategory model
    public function federationCategory()
    {
        return $this->belongsTo(FederationCategory::class, 'category_id');
    }
    
    // Define the relationship to the LocalUnion model
    public function localUnions()
    {
        return $this->hasMany(LocalUnion::class);
    }

    // Define the relationship to the FederationCategory model
    public function federationStatus()
    {
        return $this->belongsTo(FederationStatus::class, 'status_id');
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
