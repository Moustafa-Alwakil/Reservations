<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $table = 'clinics';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','name','phone','status','license','review','physican_id','created_at','updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = true;

    protected $casts = [
        'name' => 'json'
    ];

    // Start Eloquent Relations
    public function appointments()
    {
        return $this->hasMany(Appointment::class,'clinic_id','id');
    }
    public function physican()
    {
        return $this->belongsTo(Physican::class,'physican_id','id');
    }
    public function address()
    {
        return $this->hasOne(Address::class,'clinic_id','id');
    }
    public function examfee()
    {
        return $this->hasOne(Examfee::class,'clinic_id','id');
    }
    public function clinicphotos()
    {
        return $this->hasMany(Clinicphoto::class,'clinic_id','id');
    }
    public function exceptions()
    {
        return $this->hasMany(Exception::class,'clinic_id','id');
    }
    public function workday()
    {
        return $this->hasOne(Workday::class,'clinic_id','id');
    }
    public function services()
    {
        return $this->belongsToMany(service::class, 'clinics_services', 'clinic_id', 'service_id', 'id', 'id')->as('clinics_services');
    }
    // End Elqouent Relations

    // Define Accesors To Translate The Values Meaning
    public function getStatusAttribute($value)
    {
        if($value==1){
            return ucwords('active');
        };
        return ucwords('not active');
    }
    public function getReviewAttribute($value)
    {
        if($value==0){
            return ucwords('not accepted');
        };
        if($value==1){
            return ucwords('accepted');
        };
        return ucwords('waiting');
    }
    public function getLicenseAttribute($value)
    {
        return url('images/clinics-licenses/' . $value);
    }
    // End Accessors
}
