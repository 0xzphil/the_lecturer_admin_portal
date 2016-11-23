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
        	'ten_bo_mon' => 'Công nghệ phần mềm',
	    	'mo_ta' =>'none',
	    	'khoa_id' => 1
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Các hệ thống thông tin',
            'mo_ta' =>'none',
            'khoa_id' => 1
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Khoa học máy tính',
            'mo_ta' =>'none',
            'khoa_id' => 1
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Khoa học và Kỹ thuật tính toán',
            'mo_ta' =>'none',
            'khoa_id' => 1
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Mạng và Truyền thông Máy tính',
            'mo_ta' =>'none',
            'khoa_id' => 1
        ]);
        //
        Bo_mon::insert([
            'ten_bo_mon' => 'Thông tin vô tuyến',
            'mo_ta' =>'none',
            'khoa_id' => 2
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Vi cơ điện tử và Vi cơ hệ thống',
            'mo_ta' =>'none',
            'khoa_id' => 2
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Hệ thống viễn thông',
            'mo_ta' =>'none',
            'khoa_id' => 2
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Điện tử và Kỹ thuật máy tính',
            'mo_ta' =>'none',
            'khoa_id' => 2
        ]);
        //
        //
        Bo_mon::insert([
            'ten_bo_mon' => 'Công nghệ quang tử',
            'mo_ta' =>'none',
            'khoa_id' => 3
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Vật liệu và linh kiện từ tính nano',
            'mo_ta' =>'none',
            'khoa_id' => 3
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Vật liệu và linh kiện bán dẫn nano',
            'mo_ta' =>'none',
            'khoa_id' => 3
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Công nghệ nano sinh học',
            'mo_ta' =>'none',
            'khoa_id' => 3
        ]);

        //
        Bo_mon::insert([
            'ten_bo_mon' => 'Thủy Khí Công nghiệp và Môi trường',
            'mo_ta' =>'none',
            'khoa_id' => 4
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Công nghệ Biển và Môi trường',
            'mo_ta' =>'none',
            'khoa_id' => 4
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Công nghệ Hàng không vũ trụ',
            'mo_ta' =>'none',
            'khoa_id' => 4
        ]);
        Bo_mon::insert([
            'ten_bo_mon' => 'Công nghệ Cơ điện tử',
            'mo_ta' =>'none',
            'khoa_id' => 4
        ]);



    }
}
