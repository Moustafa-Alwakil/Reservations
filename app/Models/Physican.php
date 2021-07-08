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
        'id','name','gender','email','password','remember_token','email_verified_at','code','status','birthdate','department_id','info_id','created_at','updated_at'
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Start Eloquent Relations
    public function cetificates()
    {
        return $this->hasMany(Certificate::class,'physican_id','id');
    }
    public function clinics()
    {
        return $this->hasMany(Clinic::class,'physican_id','id');
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class,'physican_id','id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function info()
    {
        return $this->hasOne(Info::class,'info_id','id');
    }
    public function patients()
    {
        return $this->belongsToMany(Patient::class,'reviews','physican_id','patient_id','id','id')->as('reviews');
    }
    // End Elqouent Relations

    // Define Accesors To Translate The Values Meaning
    public function getStatusAttribute($value)
    {
        if($value==1){
            return ucfirst('verified');
        }elseif($value==2){
            return ucfirst('banned');
        }
        return ucfirst('not verified');
    }
    // End Accessors
}
