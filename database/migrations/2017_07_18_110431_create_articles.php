<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('content.articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seo_title')->nullable()->comment('заголовок страницы');
            $table->string('seo_desc')->nullable()->comment('описание страницы');
            $table->string('seo_keys')->nullable()->comment('ключевые слова');
            $table->string('translit')->nullable()->comment('транслит статьи для чпу');
            $table->string('title')->comment('заголовок статью');
            $table->text('desc')->comment('контент статьи');
            $table->integer('file_id')->nullable()->unsigned()->comment('главное изображение статьи');
            $table->integer('user_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('public.users');
            $table->foreign('file_id')->references('id')->on('content.files');
            
            $table->unique('translit');
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
        Schema::drop('content.articles');
    }
}
