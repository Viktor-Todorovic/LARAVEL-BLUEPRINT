<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@salon.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true
        ]);

        User::create([
            'name' => 'Viktor',
            'email' => 'vtodorovic5323it@raf.rs',
            'password' => Hash::make('viktor123'),
            'is_admin' => false
        ]);
       
        $this->call([
        ServiceSeeder::class,
        MaterialSeeder::class,
        ProductSeeder::class,
        AppointmentSeeder::class,

    ]);
    }
}
