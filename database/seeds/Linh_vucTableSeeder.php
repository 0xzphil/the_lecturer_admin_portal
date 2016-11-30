<?php

use Illuminate\Database\Seeder;

use App\Linh_vuc;

class Linh_vucTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Linh_vuc::insert([
            'ten_linh_vuc' => 'Hệ thống điểu khiển tự động',
            'mo_ta' => 'none',
            'parent_id' => 1
        ]);
        Linh_vuc::insert([
            'ten_linh_vuc' => ' Công nghệ phần mềm',
            'mo_ta' => 'none',
            'parent_id' => 1
        ]);
        Linh_vuc::insert([
            'ten_linh_vuc' => 'Phần mềm hệ thống',
            'mo_ta' => 'none',
            'parent_id' => 1
        ]);
        Linh_vuc::insert([
            'ten_linh_vuc' => 'Lý thuyết và mô hình hóa',
            'mo_ta' => 'none',
            'parent_id' => 1
        ]);
        Linh_vuc::insert([
            'ten_linh_vuc' => 'Lý thuyết thông tin',
            'mo_ta' => 'none',
            'parent_id' => 2
        ]);
        Linh_vuc::insert([
            'ten_linh_vuc' => 'Kiến trúc thông tin',
            'mo_ta' => 'none',
            'parent_id' => 2
        ]);

    }
}
