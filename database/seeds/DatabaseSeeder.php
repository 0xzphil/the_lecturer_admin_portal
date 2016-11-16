<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KhoaTableSeeder::class);
        $this->call(Bo_monTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(Giang_vienTableSeeder::class);
        $this->call(Nhan_vien_khoaTableSeeder::class);
        $this->call(Linh_vucTableSeeder::class);
        $this->call(Huong_nghien_cuuTableSeeder::class);
        $this->call(Phong_thi_nghiemTableSeeder::class);
        //$this
        // Khoa
        // Bo mon
        // User
        // Giang vien
    }
}
