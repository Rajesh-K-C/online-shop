<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->realText(),
            // 'image' => fake()->imageUrl(),
            'image' => "1724602015_1.jpg",
            'status' => fake()->boolean() ? 1 : 0,
            'price' => fake()->randomFloat(2, 200, 3000),
            'stock' => fake()->numberBetween(0, 40),
            'created_by' => 1,
        ];
    }
}
