<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Giangvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Neu la giang vien thi se co nhung thuoc tinh duoi day
        Schema::create('giang_viens', function (Blueprint $table) {
            //$table->increments('id');

            $table->integer('user_id')->unsigned()->unique(); // khoa ngoai den users table
            $table->string('ma_giang_vien', 20)->unique();
            $table->primary('ma_giang_vien');
            $table->integer('bo_mon_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');   
            $table->foreign('bo_mon_id')
                  ->references('id')
                  ->on('bo_mons')
                  ->onDelete('cascade'); 
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
        Schema::drop('giang_viens');
    }
}
