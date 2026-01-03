<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'material_id' => Material::factory(),
            'price' => fake()->randomFloat(2, 0, 999999.99),
            'image_path' => fake()->word(),
        ];
    }
}
