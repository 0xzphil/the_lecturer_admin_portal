s<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Linhvuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('linh_vucs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_linh_vuc', 200);
            $table->string('mo_ta', 9000);
            $table->integer('giang_vien_id')->unsigned();
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
