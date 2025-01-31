<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'guid',
        'email',
        'password',
        'fname',
        'mname',
        'lname',
        'photo',
        'status_id',
        'role_id',
        'trade_federation_id',
        'local_union_id',
    ];

    // Define the relationship to the UserStatus model
    public function userStatus()
    {
        return $this->belongsTo(UserStatus::class, 'status_id');
    }

    // Define the relationship to the UserRole model
    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Automatically generate a UUID when creating a new instance
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string) Str::uuid();
        });
    }
}
