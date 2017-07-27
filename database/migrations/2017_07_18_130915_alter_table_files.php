<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content.files', function (Blueprint $table) {
            $table->string('filepath')->nullable();
            $table->text('mime_type')->nullable();
            $table->text('original_name')->nullable();
            $table->integer('size')->nullable();
            $table->string('extension')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content.files', function (Blueprint $table) {
            $table->dropColumn(['filepath','mime_type',
                'original_name','size','extension']);
        });
    }
}
