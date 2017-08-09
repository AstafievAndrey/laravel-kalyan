<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->comment('ид роли');
            $table->integer('user_id')->comment('ид пользователя');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade');
            
            $table->unique(['role_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
