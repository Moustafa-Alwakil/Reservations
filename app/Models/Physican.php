<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Physican extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'physicans';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'gender', 'email', 'password', 'remember_token', 'email_verified_at', 'code', 'status', 'birthdate', 'department_id', 'created_at', 'updated_at'
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

    // Start Eloquent Relations
    public function cetificates()
    {
        return $this->hasMany(Certificate::class, 'physican_id', 'id');
    }
    public function clinics()
    {
        return $this->hasMany(Clinic::class, 'physican_id', 'id');
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class, 'physican_id', 'id');
    }
    public function info()
    {
        return $this->hasOne(Info::class, 'physican_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'reviews', 'physican_id', 'user_id', 'id', 'id')->as('reviews');
    }
    // End Elqouent Relations

    // Define Accesors To Translate The Values Meaning
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
