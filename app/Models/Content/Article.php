<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    //
    use SoftDeletes;
    protected $table = 'content.articles';
    protected $dates = ['deleted_at'];
    
    /**      
     * обложка статьи
     */
    public function cover()
    {
        return $this->hasOne('App\Models\Content\File');
    }
    /**
     * категории статьи
     */
    public function categories() {
        return $this->belongsToMany(
                'App\Models\Content\Category', 
                'content.articles_categories', 
                'artcile_id', 
                'category_id'
            )->withTimestamps();
    }
}
