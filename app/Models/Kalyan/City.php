<?php

namespace App\Models\Kalyan;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $table = 'kalyan.cities';
    public $timestamps = false;
    
    public function shops()
    {
        return $this->hasMany('App\Models\Shop');
    }
}
