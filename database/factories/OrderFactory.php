<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'material_id' => Material::factory(),
            'total_price' => fake()->randomFloat(2, 0, 99999999.99),
            'status' => fake()->word(),
            'delivery_date' => fake()->date(),
        ];
    }
}
