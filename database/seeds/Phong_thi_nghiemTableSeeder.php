<?php

use Illuminate\Database\Seeder;

use App\Phong_thi_nghiem;

class Phong_thi_nghiemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Phong_thi_nghiem::insert([
        	'ten_phong_thi_nghiem' => 'Phong thi nghiem cong nghe phan mem',
	    	'khoa_id' => 1,
	    	'mo_ta' => 'none'
        ]);
    }
}
