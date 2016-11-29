<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SinhViens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinh_viens', function (Blueprint $table) {
            $table->string('ma_sinh_vien', 200)->unique();
            $table->boolean('dang_ky');

            $table->primary('ma_sinh_vien');
            $table->foreign('ma_sinh_vien')
                  ->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('khoa_hoc_id')->unsigned();
            $table->foreign('khoa_hoc_id')
                  ->references('id')
                  ->on('khoa_hocs')->onDelete('cascade')
                  ->onUpdate('cascade');
            
            $table->integer('ctdt_id')->unsigned();
            $table->foreign('ctdt_id')
                  ->references('id')
                  ->on('ctdts')->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('khoa_id')->unsigned();
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
        Schema::drop('sinh_viens');
    }
}
