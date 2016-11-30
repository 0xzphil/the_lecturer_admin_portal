<?php

use Illuminate\Database\Seeder;
use App\Sinh_vien;

class Sinh_vienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sinh_vien::insert([
        	'ma_sinh_vien' => '14020347',
            'user_id' => 5,
        	'dang_ky' => true,
        	'khoa_hoc_id' => 1,
        	'ctdt_id' => 1,
        	'khoa_id' => 1
        ]);

        Sinh_vien::insert([
        	'ma_sinh_vien' => '14020377',
            'user_id' => 6,
        	'dang_ky' => true,
        	'khoa_hoc_id' => 1,
        	'ctdt_id' => 1,
        	'khoa_id' => 1
        ]);
    }
}
