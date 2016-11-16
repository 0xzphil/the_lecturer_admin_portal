<?php

use Illuminate\Database\Seeder;

use App\Bo_mon;

class Bo_monTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bo_mon::insert([
        	'ten_bo_mon' => 'Cong nghe phan mem',
	    	'mo_ta' =>'none',
	    	'khoa_id' => 1,
	    	'ma_giang_vien' => 'AA1'
        ]);
    }
}
