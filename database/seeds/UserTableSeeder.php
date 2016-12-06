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
        	'name'   => 'giangvien',
            'password'   => Hash::make('giangvien'),
            'email'      => 'khoa.uet@gmail.com', 
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
            'name'   => 'Phi',
            'password'   => Hash::make('phiphi'),
            'email'      => 'phi.uet@gmail.com', 
            'role'       => 'giang_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 4
        User::insert([
        	'name'   => 'Minh',
            'password'   => Hash::make('minhminh'),
            'email'      => 'minh.uet@gmail.com', 
            'role'       => 'giang_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 5
        User::insert([
            'name'   => 'Loc',
            'password'   => Hash::make('locloc'),
            'email'      => 'loc.uet@gmail.com', 
            'role'       => 'sinh_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // 6
        User::insert([
            'name'   => 'Cong',
            'password'   => Hash::make('congcong'),
            'email'      => 'cong.uet@gmail.com', 
            'role'       => 'sinh_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
