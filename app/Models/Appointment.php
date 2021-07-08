<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','date','start_time','end_time','status','clinic_id','patient_id','created_at','updated_at'
    ];
    public $timestamps = true;

    // Start Eloquent Relations
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'clinic_id','id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
    // End Elqouent Relations
    
    // Define Accesors To Translate The Values Meaning
    public function getStatusAttribute($value)
    {
        if($value==1){
            return ucfirst('accepted');
        }elseif($value==2){
            return ucfirst('refused'); 
        };
        return ucfirst('waiting');
    }
    // End Accessors
}
