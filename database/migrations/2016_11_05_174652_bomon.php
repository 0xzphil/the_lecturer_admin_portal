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
        Schema::create('bo_mons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_bo_mon', 200);
            $table->string('mo_ta', 9000);
            $table->integer('khoa_id')->unsigned();
            $table->string('ma_giang_vien', 20);
            $table->foreign('khoa_id')
                  ->references('id')
                  ->on('khoas')
                  ->onDelete('cascade');
            $table->foreign('ma_giang_vien')
                  ->references('ma_giang_vien')
                  ->on('giang_viens')
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
        Schema::drop('bo_mons');
    }
}
