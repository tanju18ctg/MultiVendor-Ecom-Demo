<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::truncate();
        Seller::insert([
            'name' => 'Seller',
            'phone' => '01812852822',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('password'),
            'isVerified' => true,
        ]);
    }
}
