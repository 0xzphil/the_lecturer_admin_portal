<?php

use Illuminate\Database\Seeder;
use App\Ctdt;

class CtdtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Ctdt::insert([
        	'mo_ta' => 'Chất lượng cao'
       	]);

       	Ctdt::insert([
        	'mo_ta' => 'Nhiệm vụ chiến lược'
       	]);

       	Ctdt::insert([
        	'mo_ta' => 'Chuẩn'
       	]);
    }
}
