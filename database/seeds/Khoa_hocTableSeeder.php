<?php

use Illuminate\Database\Seeder;
use App\Khoa_hoc;

class Khoa_hocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Khoa_hoc::insert([
        	'mo_ta' => 'QHI-2014'
        ]);
    }
}
