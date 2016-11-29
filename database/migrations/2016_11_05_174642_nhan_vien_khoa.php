<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NhanVienKhoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('nhan_vien_khoas', function (Blueprint $table) {
            $table->increments('id');
            //
            $table->integer('user_id')->unsigned()->unique();
            $table->integer('khoa_id')->unsigned();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');   
            $table->foreign('khoa_id')
                  ->references('id')
                  ->on('khoas')
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
        //
        Schema::drop('nhan_vien_khoas');
    }
}
