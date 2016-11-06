<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bomon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bo_mon', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_bo_mon', 200);
            $table->string('mo_ta', 9000);
            $table->integer('khoa_id')->unsigned();
            $table->foreign('khoa_id')
                  ->references('id')
                  ->on('khoa')
                  ->onDelete('cascade');
            //
        });

        // khoa noai den khoa
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
