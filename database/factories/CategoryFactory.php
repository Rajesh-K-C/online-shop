<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'rank' => fake()->numberBetween(0, 100),
            'image' => "1724594377_1.jpg",
            'status' => fake()->numberBetween(0, 1),
            'description' => fake()->realText(),
            'created_by' => 1,
        ];
    }
}
