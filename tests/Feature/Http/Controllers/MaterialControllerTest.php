<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class MaterialControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    #[Test]
    public function index_displays_view(): void
    {
        Material::factory()->create();
        $response = $this->actingAs($this->user)->get(route('materials.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = 'Novi Materijal';
        $response = $this->actingAs($this->user)->post(route('materials.store'), [
            'name' => $name,
            'type' => 'test-type',
            'stock_quantity' => 50,
            'price_per_meter' => 10.5,
        ]);

        $response->assertRedirect(route('materials.index'));
        $this->assertDatabaseHas('materials', ['name' => $name]);
    }
}
