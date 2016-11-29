<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DanhGia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('de_tai_id')->unsigned();
            $table->foreign('de_tai_id')
                    ->references('id')
                    ->on('de_tais')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('nhan_xet',2000);
            $table->float('diem',8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('danh_gias');
    }
}
