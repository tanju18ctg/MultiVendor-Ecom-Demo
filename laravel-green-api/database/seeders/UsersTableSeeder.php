<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::insert([
            'name' => 'user',
            'phone' => '01881514131',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'isVerified' => true,
        ]);


    }
}
