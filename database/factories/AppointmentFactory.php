<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'client_name' => fake()->regexify('[A-Za-z0-9]{150}'),
            'client_phone' => fake()->regexify('[A-Za-z0-9]{20}'),
            'service_id' => Service::factory(),
            'appointment_date' => fake()->dateTime(),
        ];
    }
}
