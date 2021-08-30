<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $table = 'certificates';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','type','university','field','start_date','end_date','photo','physican_id','created_at','updated_at'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = true;

    protected $casts = [
        'university' => 'json',
        'field' => 'json',
    ];

    // Start Eloquent Relations
    public function physican()
    {
        return $this->belongsTo(Physican::class,'physican_id','id');
    }
    // End Elqouent Relations

    // Define Accesors To Translate The Values Meaning
    public function getTypeAttribute($value)
    {
        if($value==1){
            return ucwords('bachelor');
        }elseif($value==2){
            return ucwords('master');
        }elseif($value==3){
            return strtoupper('phd');
        }elseif($value==4){
            return ucwords('fellowship');
        }
    }
    public function getPhotoAttribute($value)
    {
        return url('images/certificates/'.$value);
    }
    // End Accessors
}
