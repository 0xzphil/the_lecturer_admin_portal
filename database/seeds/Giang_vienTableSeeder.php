<?php

use Illuminate\Database\Seeder;

use App\Giang_vien;

class Giang_vienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Giang_vien::insert([
        	'ma_giang_vien' => 'AA1',
    		'user_id' => 1,
    		'bo_mon_id' => 1
        ]);
    }
}
