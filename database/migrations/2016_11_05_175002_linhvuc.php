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
            $table->integer('parent_id')->unsigned()->default(1);
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('linh_vuc_co_bans')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->string('mo_ta', 9000);
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
        Schema::drop('linh_vucs');
    }
}
