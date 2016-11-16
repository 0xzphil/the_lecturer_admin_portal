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
        	'ten_linh_vuc' => 'Mang va truyen thong',
    		'mo_ta' => 'none'
        ]);
    }
}
