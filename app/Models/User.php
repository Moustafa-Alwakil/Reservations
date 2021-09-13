<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'gender', 'email', 'password', 'phone', 'code', 'remember_token', 'email_verified_at', 'birthdate', 'created_at', 'updated_at'
    ];

    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'name' => 'json'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Start Eloquent Relations
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id', 'id');
    }
    public function reviews()
    {
        return $this->belongsToMany(Physican::class, 'reviews', 'user_id', 'physican_id', 'id', 'id')->as('reviews');
    }
    // End Elqouent Relations

    // Define Accesors 
    public function getGenderAttribute($value)
    {
        if ($value == 'm') {
            return ucwords('male');
        } elseif ($value == 'f') {
            return ucwords('female');
        }
    }
    // End Accessors
}
