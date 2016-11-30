<?php

use Illuminate\Database\Seeder;
use App\Linh_vuc_co_ban;

class Linh_vuc_co_banTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        Linh_vuc_co_ban::insert([
        	'ten' => 'Khoa học máy tính'
        ]);
        Linh_vuc_co_ban::insert([
            'ten' => 'Khoa học thông tin',
            'mo_ta' => 'none'
        ]);
    }
}
