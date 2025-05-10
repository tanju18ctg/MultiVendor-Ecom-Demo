<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->userName(),
            'slug' => $this->faker->unique()->slug,
            'image' => $this->faker->imageUrl('250','120'),
            'status' => $this->faker->randomElement(['active','inactive']),
         ];
    }
}
