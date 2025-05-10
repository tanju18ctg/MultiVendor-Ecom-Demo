<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Color>
 */
class ColorFactory extends Factory
{

    protected $model = Color::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $colors = ['Red','Green','Yellow','Blue','White'];
        return [
            'name' => $this->faker->unique()->randomElement($colors),
            'status' => $this->faker->randomElement(['active','inactive'])
         ];
    }
}
