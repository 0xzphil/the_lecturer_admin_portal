<?php

use Illuminate\Database\Seeder;

use App\Nhan_vien_khoa;

class Nhan_vien_khoaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Nhan_vien_khoa::insert([
        	'user_id' => 2,
    		'khoa_id' => 1
        ]);
    }
}
