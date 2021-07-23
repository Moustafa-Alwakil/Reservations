<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $table = 'experiences';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','title','place','start_date','end_date','status','physican_id','created_at','updated_at'
    ];
    public $timestamps = true;

    protected $casts = [
        'title' => 'json',
        'place' => 'json',
    ];

    // Start Eloquent Relations
    public function physican()
    {
        return $this->belongsTo(Physican::class,'physican_id','id');
    }
    // End Elqouent Relations

    // Define Accesors To Translate The Values Meaning
    public function getStatusAttribute($value)
    {
        if($value==0){
            return ucwords('left job');
        };
        return ucwords('current job');
    }
    // End Accessors
}
