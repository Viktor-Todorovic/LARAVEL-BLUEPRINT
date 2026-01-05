<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'stock_quantity' => fake()->numberBetween(10, 100),
            'price_per_meter' => fake()->randomFloat(2, 500, 5000),
        ];
    }
}
