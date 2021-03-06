<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $table = 'regions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'name', 'status', 'city_id', 'created_at', 'updated_at'
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
    public function addresses()
    {
        return $this->hasMany(Address::class, 'region_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    // End Elqouent Relations

    // Define Accesors To Translate The Values Meaning
    public function getStatusAttribute($value)
    {
        if ($value == 1) {
            return ucwords('active');
        };
        return ucwords('not active');
    }
    // End Accessors
}
