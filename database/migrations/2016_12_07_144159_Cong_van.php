<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CongVan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cong_vans', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('khoa_id')->unsigned();
            $table->foreign('khoa_id')
                    ->references('id')
                    ->on('khoas')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('pathfile', 200);
            $table->string('pathattachfile',200);
            $table->string('mo_ta', 2000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cong_vans');        
    }
}
