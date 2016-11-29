<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Map extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
             $table->integer('linh_vuc_id')->unsigned();
             $table->integer('huong_nghien_cuu_id')->unsigned();
             $table->primary(['linh_vuc_id','huong_nghien_cuu_id']);

             $table->foreign('linh_vuc_id')
                    ->references('id')
                    ->on('linh_vucs')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('huong_nghien_cuu_id')
                    ->references('id')
                    ->on('huong_nghien_cuus')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maps');
    }
}
