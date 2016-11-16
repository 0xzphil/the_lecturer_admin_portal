<?php

use Illuminate\Database\Seeder;

use App\Huong_nghien_cuu;

class Huong_nghien_cuuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Huong_nghien_cuu::insert([
            
            'ten_huong_nghien_cuu' => 'Huong nghien cuu 1',
            'mo_ta' => 'none',
            'linh_vuc_id' => 1,
            'ma_giang_vien' => 'AA1'
        ]);
    }
}
