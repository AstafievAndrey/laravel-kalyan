<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $table = 'content.files';
    protected $dates = ['deleted_at'];
    
    /**
     *  Статьи у которых файл в качестве обложки
     */
    public function coverArticles()
    {
        return $this->hasMany('App\Models\Content\Article');
    }
}
