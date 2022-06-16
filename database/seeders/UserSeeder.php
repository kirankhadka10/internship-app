<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  =>  'Admin',
            'email' =>  'admin@admin.com',
            'password'  =>  bcrypt('password'),
            'phone'     =>  '9456245678',
            'username'  =>  'admin',
            'role'      =>  'Admin',
        ]);

        User::create([
            'name'  =>  'User',
            'email' =>  'user@user.com',
            'password'  =>  bcrypt('password'),
            'phone'     =>  '9456245679',
            'username'  =>  'user',
            'role'      =>  'User',
        ]);

        User::factory()->times(25)->create();
    }
}
