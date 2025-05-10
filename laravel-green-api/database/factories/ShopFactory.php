<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{

    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seller_id' => $this->faker->randomElement(Seller::pluck('id')->toArray()),
            'name' => $this->faker->unique()->userName(),
            'slug' => $this->faker->unique()->slug,
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'address' => $this->faker->address(),
            'followers' => $this->faker->numberBetween(200,800),
         ];
    }
}
