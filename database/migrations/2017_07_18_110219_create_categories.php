<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('content.categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seo_title')->nullable()->comment('заголовок категории');
            $table->string('seo_desc')->nullable()->comment('описание категории');
            $table->string('seo_keys')->nullable()->comment('ключевые слова категории');
            $table->string('translit')->nullable()->comment('транслит категории');
            $table->string('name')->comment('название категории');
            
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
        Schema::drop('content.categories');
    }
}
