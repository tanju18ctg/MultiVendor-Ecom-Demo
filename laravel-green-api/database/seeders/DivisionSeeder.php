<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::truncate();
        Division::insert([

            [
                "id" => 1,
                "name" => "Dhaka",
                "bn_name" => "ঢাকা",
                "charge" => 60,
            ],
            [
                "id" => 2,
                "name" => "Chittagong",
                "bn_name" => "চট্টগ্রাম",
                "charge" => 100,
            ],
            [
                "id" => 3,
                "name" => "Rajshahi",
                "bn_name" => "রাজশাহী",
                "charge" => 100,
            ],
            [
                "id" => 4,
                "name" => "Khulna",
                "bn_name" => "খুলনা",
                "charge" => 100,
            ],
            [
                "id" => 5,
                "name" => "Barisal",
                "bn_name" => "বরিশাল",
                "charge" => 100,
            ],
            [
                "id" => 6,
                "name" => "Rangpur",
                "bn_name" => "রংপুর",
                "charge" => 100,
            ],
            [
                "id" => 7,
                "name" => "Sylhet",
                "bn_name" => "সিলেট",
                "charge" => 100,
            ],
            [
                "id" => 8,
                "name" => "Mymensingh",
                "bn_name" => "ময়মনসিংহ",
                "charge" => 100,
            ]

        ]);
    }
}
