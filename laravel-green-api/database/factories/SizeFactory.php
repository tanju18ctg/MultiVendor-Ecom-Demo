<?php

namespace Database\Factories;

use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Size>
 */
class SizeFactory extends Factory
{

    protected $model = Size::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sizes = ['S','M','L','XL','XXL'];
        return [
            'name' => $this->faker->unique()->randomElement($sizes),
            'status' => $this->faker->randomElement(['active','inactive'])
        ];
    }
}
