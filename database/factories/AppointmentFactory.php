<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'service_id' => Service::factory(),
            'appointment_date' => fake()->dateTime(),
            'status' => fake()->word(),
            'notes' => fake()->text(),
        ];
    }
}
