<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Material;
use App\Models\Product;
use App\Models\User; // Dodato
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
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
        $response->assertViewHas('products', $products);
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
        $price = fake()->randomFloat(2, 10, 1000);

        $response = $this->actingAs($this->user)->post(route('products.store'), [
            'name' => $name,
            'description' => $description,
            'material_id' => $material->id,
            'price' => $price,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('material_id', $material->id)
            ->where('price', $price)
            ->get();

        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);
    }

    #[Test]
    public function show_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->get(route('products.show', $product));

        $response->assertOk();
        $response->assertViewIs('product.show');
        $response->assertViewHas('product', $product);
    }

    #[Test]
    public function edit_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->user)->get(route('products.edit', $product));

        $response->assertOk();
        $response->assertViewIs('product.edit');
        $response->assertViewHas('product', $product);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $product = Product::factory()->create();
        $name = fake()->name();
        $description = fake()->text();
        $material = Material::factory()->create();
        $price = fake()->randomFloat(2, 10, 1000);

        $response = $this->actingAs($this->user)->put(route('products.update', $product), [
            'name' => $name,
            'description' => $description,
            'material_id' => $material->id,
            'price' => $price,
        ]);

        $product->refresh();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);

        $this->assertEquals($name, $product->name);
        $this->assertEquals($description, $product->description);
        $this->assertEquals($material->id, $product->material_id);
        $this->assertEquals($price, $product->price);
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
