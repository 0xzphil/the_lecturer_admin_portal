<?php

use Illuminate\Database\Seeder;
use App\Map;

class MapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Map::insert([
            'linh_vuc_id' => 1,
            'huong_nghien_cuu_id' => 1
        ]);
        Map::insert([
            'linh_vuc_id' => 2,
            'huong_nghien_cuu_id' => 1
        ]);
        Map::insert([
            'linh_vuc_id' => 3,
            'huong_nghien_cuu_id' => 1
        ]);
    }
}
