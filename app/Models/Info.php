<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $table = 'infos';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','title','license','photo','about','physican_id','created_at','updated_at'
    ];
    public $timestamps = true;

    protected $casts = [
        'about' => 'json'
    ];

    // Start Eloquent Relations
    public function physican()
    {
        return $this->belongsTo(physican::class,'physican_id','id');
    }
    // End Elqouent Relations

    // Define Accesors To Translate The Values Meaning
    public function getPhotoAttribute($value)
    {
        return url('images/docphotos/'.$value);
    }
    public function getLicenseAttribute($value)
    {
        return url('/images/licenses/'.$value);
    }
    // End Accessors

}
