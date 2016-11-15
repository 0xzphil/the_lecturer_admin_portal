<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Huongnghiencuu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('huong_nghien_cuus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_huong_nghien_cuu', 200);
            $table->string('mo_ta', 9000);
            $table->integer('linh_vuc_id')->unsigned();
            $table->string('ma_giang_vien', 20);
            $table->foreign('ma_giang_vien')
                  ->references('ma_giang_vien')
                  ->on('giang_viens')
                  ->onDelete('cascade');
            $table->foreign('linh_vuc_id')
                  ->references('id')
                  ->on('linh_vucs')
                  ->onDelete('cascade');
            //

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
    }
}
