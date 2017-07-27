<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telegram extends Model
{
    //
    use SoftDeletes;
    protected $table = 'content.telegram';
    protected $dates = ['deleted_at'];
}
