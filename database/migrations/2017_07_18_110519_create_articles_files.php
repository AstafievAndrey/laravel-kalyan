<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('content.articles_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id')->comment('ид файла');
            $table->integer('article_id')->nullable()->comment('ид статьи');
            
            $table->foreign('file_id')->references('id')->on('content.files')
                    ->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('content.articles')
                    ->onDelete('cascade');
            
            $table->unique(['file_id', 'article_id']);
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
        Schema::drop('content.articles_files');
    }
}
