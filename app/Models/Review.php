<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Review extends Pivot
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $fillable = [
       'comment','value','physican_id','user_id','created_at','updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = true;

    // Start Eloquent Relations
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function physican()
    {
        return $this->belongsTo(Physican::class,'physican_id','id');
    }
    // End Elqouent Relations
}
