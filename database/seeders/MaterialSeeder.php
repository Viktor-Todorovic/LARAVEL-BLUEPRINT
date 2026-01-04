<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::create([
            'name' => 'Vuna',
            'stock_quantity' => 50,
            'price_per_meter' => 2500.00
        ]);

        Material::create([
            'name' => 'Pamuk',
            'stock_quantity' => 100,
            'price_per_meter' => 1200.00
        ]);
    }
}
