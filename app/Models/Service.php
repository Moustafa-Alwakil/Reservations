<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','name','status','department_id','created_at','updated_at'
    ];
    public $timestamps = true;

    protected $casts = [
        'name' => 'json'
    ];

    // Start Eloquent Relations
    public function department()
    {
        return $this->belongsTo(Department::class, 'depatment_id','id');
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
    // End Accessors
}
