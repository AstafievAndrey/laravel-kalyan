<?php

namespace App\Models\Kalyan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    //
    protected $table = 'kalyan.files';
    protected $dates = ['deleted_at'];
}
