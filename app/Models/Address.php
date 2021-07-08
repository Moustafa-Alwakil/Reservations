<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','street','bulidingno','floor','apartno','landmark','region_id','created_at','updated_at'
    ];
    public $timestamps = true;

    // Start Eloquent Relations
    public function region()
    {
        return $this->belongsTo(Region::class,'region_id','id');
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'address_id','id');
    }
    // End Elqouent Relations
    //jsdjkfolds
    //esraa comment
    // 3mlt tgheer bs mosh mot2ked
}