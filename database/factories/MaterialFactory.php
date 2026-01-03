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
            'name' => fake()->name(),
            'type' => fake()->regexify('[A-Za-z0-9]{50}'),
            'stock_quantity' => fake()->numberBetween(-10000, 10000),
            'price_per_meter' => fake()->randomFloat(2, 0, 999999.99),
        ];
    }
}
