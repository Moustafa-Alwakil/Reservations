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
       'id','date','start_time','end_time','status','clinic_id','user_id','created_at','updated_at'
    ];
    public $timestamps = true;

    // Start Eloquent Relations
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'clinic_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    // End Elqouent Relations
    
    // Define Accesors To Translate The Values Meaning
    public function getStatusAttribute($value)
    {
        if($value==1){
            return ucwords('accepted');
        }elseif($value==2){
            return ucwords('refused'); 
        };
        return ucwords('waiting');
    }
    // End Accessors
}
