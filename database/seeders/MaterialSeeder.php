<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

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
            'price_per_meter' => 2500.00,
        ]);

        Material::create([
            'name' => 'Pamuk',
            'stock_quantity' => 100,
            'price_per_meter' => 1200.00,
        ]);
    }
}
