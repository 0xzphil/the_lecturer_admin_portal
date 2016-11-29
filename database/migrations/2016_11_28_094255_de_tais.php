<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeTais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('de_tais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_de_tai',200);
            $table->string('ma_giang_vien',20);
            $table->foreign('ma_giang_vien')
                    ->references('ma_giang_vien')
                    ->on('giang_viens')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->string('ma_sinh_vien',200);
            $table->foreign('ma_sinh_vien')
                    ->references('ma_sinh_vien')
                    ->on('sinh_viens')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->boolean('trang_thai_gv');
            $table->boolean('trung');
            $table->boolean('ho_so');
            $table->boolean('hop_thuc');
            $table->boolean('hoan_tat');
            $table->boolean('rut');
            $table->boolean('qd_rut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('de_tais');
    }
}
