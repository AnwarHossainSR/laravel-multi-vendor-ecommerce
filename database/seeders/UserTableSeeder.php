<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'full_name'=>'Anwar Hossain',
                'username'=>'Admin',
                'email'=>'admin@gmail.com',
                'email_verified_at' => now(),
                'password'=>Hash::make('admin'),
                'role'=>'admin',
                'status'=>'active'
            ],
            [
                'full_name'=>'Anwar Hossain',
                'username'=>'Vendor',
                'email'=>'vendor@gmail.com',
                'email_verified_at' => now(),
                'password'=>Hash::make('vendor'),
                'role'=>'vendor',
                'status'=>'active'
            ],
            [
                'full_name'=>'Anwar Hossain',
                'username'=>'Customer',
                'email'=>'customer@gmail.com',
                'email_verified_at' => now(),
                'password'=>Hash::make('customer'),
                'role'=>'customer',
                'status'=>'active'
            ]
        ]);
    }
}
