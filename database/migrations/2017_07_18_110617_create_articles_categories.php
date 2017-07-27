<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('content.articles_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->comment('ид категории');
            $table->integer('article_id')->comment('ид статьи');
            
            $table->foreign('category_id')->references('id')->on('content.categories')
                    ->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('content.articles')
                    ->onDelete('cascade');
            
            $table->unique(['category_id', 'article_id']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('content.articles_categories');
    }
}
