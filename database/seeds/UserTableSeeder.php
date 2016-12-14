<?php

use Illuminate\Database\Seeder;

use App\User;

use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        User::insert([
        	'name'   => 'T.S Lê Đình Thanh',
            'password'   => Hash::make('giangvien'),
            'email'      => 'giangvien.uet@gmail.com', 
            'role'       => 'giang_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 2
        User::insert([
        	'name'   => 'Hieu',
            'password'   => Hash::make('hieuhieu'),
            'email'      => 'hieu.uet@gmail.com', 
            'role'       => 'khoa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 3
        User::insert([
            'name'   => 'Phi Nguyễn',
            'password'   => Hash::make('phiphi'),
            'email'      => 'phi.uet@gmail.com', 
            'role'       => 'giang_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 4
        User::insert([
        	'name'   => 'Nguyễn Văn Minh',
            'password'   => Hash::make('minhminh'),
            'email'      => 'minh.uet@gmail.com', 
            'role'       => 'giang_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 5
        User::insert([
            'name'   => 'Đinh Tiến Lộc',
            'password'   => Hash::make('123456'),
            'email'      => '14020347@vnu.edu.vn', 
            'role'       => 'sinh_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 6
        User::insert([
            'name'   => 'Hữu Công',
            'password'   => Hash::make('123456'),
            'email'      => '14020377@vnu.edu.vn', 
            'role'       => 'sinh_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
