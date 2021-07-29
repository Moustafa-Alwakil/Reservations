<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClinicService extends Pivot
{
    protected $table = 'clinics_services';
    protected $primaryKey = 'id';
    protected $fillable = [
       'clinic_id','service_id','created_at','updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = true;

    // Start Eloquent Relations
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'clinic_id','id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
    // End Elqouent Relations
}
