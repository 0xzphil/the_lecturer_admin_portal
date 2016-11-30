<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinhVucCoBan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('linh_vuc_co_bans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten');
            $table->string('mo_ta')->default('none');
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
        Schema::drop('linh_vuc_co_bans');
    }
}
