<?php

namespace App\Models\Kalyan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shedule extends Model
{
    use SoftDeletes;
    
    protected $table = 'kalyan.shedule';
    protected $dates = ['deleted_at'];
    
    public function day()
    {
        return $this->belongsTo('App\Models\Kalyan\DaysWeek','day_id','id');
    }
    
}
