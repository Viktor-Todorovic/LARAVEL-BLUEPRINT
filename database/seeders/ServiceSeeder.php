<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Skraćivanje',
            'description' => 'Brzo i precizno skraćivanje svih vrsta proizvoda.',
            'price' => 500.00,
        ]);

        Service::create([
            'name' => 'Šivenje po meri',
            'description' => 'Kompletna izrada muških i ženskih stvari od najkvalitetnijih materijala.',
            'price' => 15000.00,
        ]);
    }
}
