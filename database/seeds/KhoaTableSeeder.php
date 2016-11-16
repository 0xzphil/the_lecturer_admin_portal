<?php

use Illuminate\Database\Seeder;

use App\Khoa;

class KhoaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Khoa::insert([

	        'ten_khoa' => 'Cong nghe thong tin', 
	    	'chu_nhiem_khoa' => 'Ai', 
	    	'mo_ta' => 'none', 
	    	'van_phong_khoa' => 'P320'
        ]);
    }
}
