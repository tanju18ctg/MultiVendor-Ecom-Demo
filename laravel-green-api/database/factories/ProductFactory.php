<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $multiImags = [$this->faker->imageUrl('450','450'),$this->faker->imageUrl('450','450'),$this->faker->imageUrl('450','450')];
        return [
            'name' => $this->faker->sentence(2,false),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->sentences(4,true),
            'stock' => $this->faker->numberBetween(100,300),
            'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
            'seller_id' => $this->faker->randomElement(Seller::pluck('id')->toArray()),
            // 'shop_id' => $this->faker->randomElement(Shop::pluck('id')->toArray()),
            'category_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),
            'subcategory_id' => $this->faker->randomElement(Subcategory::pluck('id')->toArray()),
            'thumbnail' => $this->faker->imageUrl('450','450'),
            'image' => $this->faker->randomElement([$multiImags]),
            'price' => $this->faker->numberBetween(900,5000),
            'discount' => $this->faker->numberBetween(0,99),
            // 'size' => $this->faker->randomElement(['S','M','L','XL']),
            'size' => $this->faker->randomElement([Size::pluck('name')->toArray()]),
            'color' => $this->faker->randomElement([Color::pluck('name')->toArray()]),
            'sale' => $this->faker->randomElement([true,false]),
            'conditions' => $this->faker->randomElement(['new','popular','winter','feature']),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
