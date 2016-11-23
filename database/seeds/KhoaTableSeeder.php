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
	        'ten_khoa' => 'Công nghệ thông tin', 
	    	'chu_nhiem_khoa' => 'PGS. TS. Lê Sỹ Vinh', 
	    	'mo_ta' => 'none', 
	    	'van_phong_khoa' => 'P320'
        ]);

        Khoa::insert([
            'ten_khoa' => 'Điện tử Viễn thông', 
            'chu_nhiem_khoa' => 'PGS.TS Chử Đức Trình', 
            'mo_ta' => 'none', 
            'van_phong_khoa' => 'P321'
        ]);

        Khoa::insert([
            'ten_khoa' => 'Vật lý KT và CN Nanô', 
            'chu_nhiem_khoa' => 'PGS. TS. Phạm Đức Thắng', 
            'mo_ta' => 'none', 
            'van_phong_khoa' => 'P322'
        ]);

        Khoa::insert([
            'ten_khoa' => 'Cơ học kỹ thụât và Tự động hoá', 
            'chu_nhiem_khoa' => 'PGS. TS. Đinh Văn Mạnh', 
            'mo_ta' => 'none', 
            'van_phong_khoa' => 'P323'
        ]);
    }
}
