<?php

namespace App\Models\Kalyan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Shop extends Model
{
    use SoftDeletes;
    //
    protected $table = 'kalyan.shops';
    protected $dates = ['deleted_at'];
//    public $timestamps = false;
    
    public function city()
    {
        return $this->belongsTo('App\Models\Kalyan\City');
    }
    
    public function logo()
    {
        return $this->belongsTo('App\Models\Kalyan\File','file_id','id');
    }

    public function shedule()
    {
        return $this->hasMany('App\Models\Kalyan\Shedule');
    }
}
