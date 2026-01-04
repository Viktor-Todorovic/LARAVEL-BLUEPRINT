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
        $material = Material::first();

        Product::create([
            'name' => 'Classic Muški Sako',
            'description' => 'Sako od čiste vune, spreman za nošenje.',
            'material_id' => $material->id,
            'price' => 12500.00,
            'image_path' => 'images/sako.jpg',
            'is_offer' => false
        ]);

        Product::create([
            'name' => 'Oversized duks',
            'description' => 'Pamučni duks sa kapuljačom, crna boja.',
            'material_id' => 2,
            'price' => 4500.00,
            'image_path' => 'images/duks.jpg',
            'is_offer' => true
        ]);

        Product::create([
            'name' => 'Basic crna majica',
            'description' => '100% pamuk, slim fit kroj.',
            'material_id' => 1,
            'price' => 1500.00,
            'image_path' => 'images/majica.jpg',
            'is_offer' => true
        ]);
    }
}
