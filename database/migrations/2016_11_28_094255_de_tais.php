<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeTais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('de_tais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_de_tai',200);
            $table->string('ma_giang_vien',20);
            $table->foreign('ma_giang_vien')
                    ->references('ma_giang_vien')
                    ->on('giang_viens')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->string('ma_sinh_vien',200);
            $table->foreign('ma_sinh_vien')
                    ->references('ma_sinh_vien')
                    ->on('sinh_viens')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->enum('trang_thai_gv', ['chua_xac_nhan', 'tu_choi', 'dong_y'])->default('chua_xac_nhan');
            $table->boolean('trung')->default(false);
            $table->boolean('duoc_phep_sua_doi')->default(false);
            $table->boolean('ho_so')->default(false);
            $table->boolean('hop_thuc')->default(false);
            $table->boolean('hoan_tat')->default(false);
            $table->boolean('rut')->default(false);
            $table->boolean('qd_rut')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('de_tais');
    }
}
