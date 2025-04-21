<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FederationPointPerson extends Model
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
        'guid',
        'email',
        'status_id',
    ];

    // Define the relationship to the FederationCategory model
    public function pointPersonStatus()
    {
        return $this->belongsTo(FederationPointPersonStatus::class, 'status_id');
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
