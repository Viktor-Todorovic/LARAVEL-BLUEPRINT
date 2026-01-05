<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Material;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    #[Test]
    public function index_displays_view(): void
    {
        $products = Product::factory()->count(3)->create();
        $response = $this->actingAs($this->user)->get(route('products.index'));
        $response->assertOk();
        $response->assertViewIs('product.index');
    }

    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->actingAs($this->user)->get(route('products.create'));
        $response->assertOk();
        $response->assertViewIs('product.create');
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = fake()->name();
        $description = fake()->text();
        $material = Material::factory()->create();
        $price = 100.00;

        $response = $this->actingAs($this->user)->post(route('products.store'), [
            'name' => $name,
            'description' => $description,
            'material_id' => $material->id,
            'price' => $price,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => $name,
            'price' => $price,
        ]);

        $response->assertRedirect(route('products.index'));
    }

    #[Test]
    public function show_displays_view(): void
    {
        $product = Product::factory()->create();
        $response = $this->actingAs($this->user)->get(route('products.show', $product));
        $response->assertOk();
        $response->assertViewIs('product.show');
    }

    #[Test]
    public function edit_displays_view(): void
    {
        $product = Product::factory()->create();
        $response = $this->actingAs($this->user)->get(route('products.edit', $product));
        $response->assertOk();
        $response->assertViewIs('product.edit');
    }

    #[Test]
    public function update_redirects(): void
    {
        $product = Product::factory()->create();
        $name = fake()->name();

        $response = $this->actingAs($this->user)->put(route('products.update', $product), [
            'name' => $name,
            'description' => $product->description,
            'material_id' => $product->material_id,
            'price' => $product->price,
        ]);

        $response->assertRedirect(route('products.index'));
    }

    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $product = Product::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('products.destroy', $product));
        $response->assertRedirect(route('products.index'));
        $this->assertModelMissing($product);
    }
}
