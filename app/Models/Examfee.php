<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examfee extends Model
{
    use HasFactory;
    protected $table = 'examfees';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','price','created_at','updated_at'
    ];
    public $timestamps = true;

    // Start Eloquent Relations
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'examfee_id','id');
    }
    // End Elqouent Relations
}
