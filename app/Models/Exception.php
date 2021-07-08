<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{
    use HasFactory;
    protected $table = 'exceptions';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','date','start_time','end_time','clinic_id','created_at','updated_at'
    ];
    public $timestamps = true;

    // Start Eloquent Relations
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'clinic_id','id');
    }
    // End Elqouent Relations
}
