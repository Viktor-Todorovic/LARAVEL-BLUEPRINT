<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Service;

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
            'appointment_date' => now()->addDays(3)
        ]);
    }
}
