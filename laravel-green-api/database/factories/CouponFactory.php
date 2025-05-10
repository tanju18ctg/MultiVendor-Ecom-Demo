<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' =>$this->faker->userName(),
            'value' => $this->faker->randomNumber(50,100),
            'type' => $this->faker->randomElement(['fixed','percent']),
        ];
    }
}
