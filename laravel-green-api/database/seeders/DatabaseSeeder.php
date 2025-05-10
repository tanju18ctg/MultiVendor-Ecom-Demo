<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            SellersTableSeeder::class,
            DivisionSeeder::class,
            DistrictSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        //for factories

        \App\Models\Seller::factory(10)->create();
        \App\Models\Slider::factory(5)->create();
        \App\Models\Brand::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Subcategory::factory(30)->create();
        \App\Models\Color::factory(5)->create();
        \App\Models\Size::factory(5)->create();
        \App\Models\Shop::factory(50)->create();
        \App\Models\Product::factory(30)->create();
    }
}
