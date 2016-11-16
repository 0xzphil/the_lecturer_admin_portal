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
        //
        User::insert([
        	'name'   => 'giangvien',
            'password'   => Hash::make('giangvien'),
            'email'      => 'khoa.uet@gmail.com', 
            'role'       => 'giang_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        User::insert([
        	'name'   => 'Hieu',
            'password'   => Hash::make('hieuhieu'),
            'email'      => 'hieu.uet@gmail.com', 
            'role'       => 'khoa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        User::insert([
            'name'   => 'Phi',
            'password'   => Hash::make('phiphi'),
            'email'      => 'phi.uet@gmail.com', 
            'role'       => 'giang_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        User::insert([
        	'name'   => 'Minh',
            'password'   => Hash::make('minhminh'),
            'email'      => 'minh.uet@gmail.com', 
            'role'       => 'giang_vien',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
