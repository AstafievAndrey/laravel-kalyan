<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('content.files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Название документа');
            $table->enum('type', ['doc', 'img', 'video'])->default('img')->comment('тип файла');
            $table->longText('desc')->nullable()->comment('Описание файла');
            $table->longText('ftp')->nullable()->comment('Где хранится на ftp');
            $table->binary('data')->nullable()->comment('Сам документ');
            
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
        Schema::drop('content.files');
    }
}
