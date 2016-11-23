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
        	'ten_phong_thi_nghiem' => 'Phòng thí nghiệm An toàn thông tin',
	    	'khoa_id' => 1,
	    	'mo_ta' => 'none'
        ]);
        Phong_thi_nghiem::insert([
            'ten_phong_thi_nghiem' => 'Phòng thí nghiệm công nghệ Tri thức',
            'khoa_id' => 1,
            'mo_ta' => 'none'
        ]);
        Phong_thi_nghiem::insert([
            'ten_phong_thi_nghiem' => 'Phòng thí nghiệm Hệ thống Nhúng',
            'khoa_id' => 1,
            'mo_ta' => 'none'
        ]);
        Phong_thi_nghiem::insert([
            'ten_phong_thi_nghiem' => 'Phòng thí nghiệm Tương tác Người – Máy',
            'khoa_id' => 1,
            'mo_ta' => 'none'
        ]);
        //
        Phong_thi_nghiem::insert([
            'ten_phong_thi_nghiem' => 'Phòng thí nghiệm Tín hiệu và Hệ thống',
            'khoa_id' => 2,
            'mo_ta' => 'none'
        ]);
        //
        Phong_thi_nghiem::insert([
            'ten_phong_thi_nghiem' => 'Phòng thí nghiệm Công nghệ quang tử',
            'khoa_id' => 3,
            'mo_ta' => 'none'
        ]);
        Phong_thi_nghiem::insert([
            'ten_phong_thi_nghiem' => 'Phòng thí nghiệm Vật liệu và linh kiện lai nano',
            'khoa_id' => 3,
            'mo_ta' => 'none'
        ]);
        Phong_thi_nghiem::insert([
            'ten_phong_thi_nghiem' => 'Phòng thí nghiệm Bộ môn Vật liệu và linh kiện từ tính nano',
            'khoa_id' => 3,
            'mo_ta' => 'none'
        ]);
        //
        Phong_thi_nghiem::insert([
            'ten_phong_thi_nghiem' => 'Phòng thí nghiệm Công nghệ Cơ điện tử và Thủy tin học ',
            'khoa_id' => 4,
            'mo_ta' => 'none'
        ]);
        Phong_thi_nghiem::insert([
            'ten_phong_thi_nghiem' => 'Phòng thí nghiệm cuả các viện nghiên cứu',
            'khoa_id' => 4,
            'mo_ta' => 'none'
        ]);
    }
}
