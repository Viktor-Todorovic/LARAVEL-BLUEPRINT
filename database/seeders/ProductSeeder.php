<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Material;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $material = Material::first(); // Uzimamo prvi materijal iz baze

        Product::create([
            'name' => 'Classic Muški Sako',
            'description' => 'Sako od čiste vune, spreman za nošenje.',
            'material_id' => $material->id,
            'price' => 12500.00,
            'image_path' => 'products/sako.jpg'
        ]);
    }
}
