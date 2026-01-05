<?php

namespace Tests\Feature;

use App\Models\Material;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function catalog_page_loads_correctly()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    public function can_filter_products_by_material()
    {
        $vuna = Material::factory()->create(['name' => 'Vuna']);
        $pamuk = Material::factory()->create(['name' => 'Pamuk']);

        Product::factory()->create(['name' => 'Vuneni duks', 'material_id' => $vuna->id]);
        Product::factory()->create(['name' => 'Pamučna majica', 'material_id' => $pamuk->id]);

        $response = $this->get('/products?material_id='.$vuna->id);

        $response->assertSee('Vuneni duks');
        $response->assertDontSee('Pamučna majica');
    }
}
