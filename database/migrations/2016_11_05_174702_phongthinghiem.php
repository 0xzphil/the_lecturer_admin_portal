<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Phongthinghiem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('phong_thi_nghiem', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_phong_thi_nghiem', 200);
            $table->integer('bo_mon_id')->unsigned();
            $table->string('mo_ta', 9000);
            $table->foreign('bo_mon_id')
                  ->references('id')
                  ->on('bo_mon')
                  ->onDelete('cascade');
            //
        });

        // foreign key den bo mon
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
