<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        Admin::insert([
            'name' => 'admin',
            'phone' => '01868332991',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
