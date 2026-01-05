<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $service = Service::first();

        Appointment::create([
            'client_name' => 'Viktor Todorović',
            'client_phone' => '0641234567',
            'service_id' => 1,
            'appointment_date' => now()->addDays(3),
        ]);
    }
}
