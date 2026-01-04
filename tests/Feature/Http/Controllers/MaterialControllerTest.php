<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MaterialController
 */
final class MaterialControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $materials = Material::factory()->count(3)->create();

        $response = $this->get(route('materials.index'));

        $response->assertOk();
        $response->assertViewIs('material.index');
        $response->assertViewHas('materials', $materials);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('materials.create'));

        $response->assertOk();
        $response->assertViewIs('material.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaterialController::class,
            'store',
            \App\Http\Requests\MaterialStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = fake()->name();
        $stock_quantity = fake()->numberBetween(-10000, 10000);
        $price_per_meter = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('materials.store'), [
            'name' => $name,
            'stock_quantity' => $stock_quantity,
            'price_per_meter' => $price_per_meter,
        ]);

        $materials = Material::query()
            ->where('name', $name)
            ->where('stock_quantity', $stock_quantity)
            ->where('price_per_meter', $price_per_meter)
            ->get();
        $this->assertCount(1, $materials);
        $material = $materials->first();

        $response->assertRedirect(route('materials.index'));
        $response->assertSessionHas('material.id', $material->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $material = Material::factory()->create();

        $response = $this->get(route('materials.show', $material));

        $response->assertOk();
        $response->assertViewIs('material.show');
        $response->assertViewHas('material', $material);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $material = Material::factory()->create();

        $response = $this->get(route('materials.edit', $material));

        $response->assertOk();
        $response->assertViewIs('material.edit');
        $response->assertViewHas('material', $material);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaterialController::class,
            'update',
            \App\Http\Requests\MaterialUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $material = Material::factory()->create();
        $name = fake()->name();
        $stock_quantity = fake()->numberBetween(-10000, 10000);
        $price_per_meter = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('materials.update', $material), [
            'name' => $name,
            'stock_quantity' => $stock_quantity,
            'price_per_meter' => $price_per_meter,
        ]);

        $material->refresh();

        $response->assertRedirect(route('materials.index'));
        $response->assertSessionHas('material.id', $material->id);

        $this->assertEquals($name, $material->name);
        $this->assertEquals($stock_quantity, $material->stock_quantity);
        $this->assertEquals($price_per_meter, $material->price_per_meter);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $material = Material::factory()->create();

        $response = $this->delete(route('materials.destroy', $material));

        $response->assertRedirect(route('materials.index'));

        $this->assertModelMissing($material);
    }
}
