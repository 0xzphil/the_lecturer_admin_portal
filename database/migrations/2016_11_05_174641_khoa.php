<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Khoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('khoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_khoa', 200);
            $table->string('chu_nhiem_khoa',40);
            $table->string('mo_ta', 9000);
            // list string
            $table->string('van_phong_khoa');
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
