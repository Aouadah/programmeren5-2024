<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'title' => fake()->word(),
            'slug' => fake()->slug(),
            'genre' => fake()->word(),
            'duration' => fake()->numberBetween(70, 120),
            'year_of_release' => fake()->numberBetween(1980, 2024),
            'rating' => fake()->numberBetween(1, 10),
        ];
    }
}
