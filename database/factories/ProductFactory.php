<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 1000, 10000),
            'material_id' => \App\Models\Material::factory(),
            'image_path' => 'images/test.jpg',
            'is_offer' => false,
        ];
    }
}
