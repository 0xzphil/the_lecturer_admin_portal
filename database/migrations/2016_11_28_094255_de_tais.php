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
            $table->string('ten_de_tai',500);
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
            $table->boolean('yeu_cau_sua')->default(false);
            $table->boolean('ho_so')->default(false);
            $table->boolean('hop_thuc')->default(false);
            $table->boolean('hoan_tat')->default(false);
            $table->boolean('rut')->default(false);
            $table->boolean('bao_ve')->default(false);
            $table->boolean('duoc_bao_ve')->default(false);
            $table->boolean('phan_cong')->default(false);
            $table->boolean('xuat_phan_cong')->default(false);
            $table->boolean('chot_phan_bien')->default(false);
            $table->boolean('sau_bao_ve')->default(false);
            $table->string('ten_de_tai2',500)->default("");
            $table->string('ma_giang_vien2',20)->default("");
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
