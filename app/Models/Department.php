<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id','name','status','created_at','updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = true;

    protected $casts = [
        'name' => 'json'
    ];
    
    // Start Eloquent Relations
    public function physicans()
    {
        return $this->hasMany(Physican::class,'department_id','id');
    }
    public function services()
    {
        return $this->hasMany(Service::class,'department_id','id');
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
