<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Material;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderController
 */
final class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('orders.index'));

        $response->assertOk();
        $response->assertViewIs('order.index');
        $response->assertViewHas('orders', $orders);
    }

    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('orders.create'));

        $response->assertOk();
        $response->assertViewIs('order.create');
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'store',
            \App\Http\Requests\OrderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $material = Material::factory()->create();
        $total_price = fake()->randomFloat(/** decimal_attributes **/);
        $status = fake()->word();

        $response = $this->post(route('orders.store'), [
            'user_id' => $user->id,
            'material_id' => $material->id,
            'total_price' => $total_price,
            'status' => $status,
        ]);

        $orders = Order::query()
            ->where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->where('total_price', $total_price)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('order.id', $order->id);
    }

    #[Test]
    public function show_displays_view(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertViewIs('order.show');
        $response->assertViewHas('order', $order);
    }

    #[Test]
    public function edit_displays_view(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.edit', $order));

        $response->assertOk();
        $response->assertViewIs('order.edit');
        $response->assertViewHas('order', $order);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'update',
            \App\Http\Requests\OrderUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();
        $material = Material::factory()->create();
        $total_price = fake()->randomFloat(/** decimal_attributes **/);
        $status = fake()->word();

        $response = $this->put(route('orders.update', $order), [
            'user_id' => $user->id,
            'material_id' => $material->id,
            'total_price' => $total_price,
            'status' => $status,
        ]);

        $order->refresh();

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('order.id', $order->id);

        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals($material->id, $order->material_id);
        $this->assertEquals($total_price, $order->total_price);
        $this->assertEquals($status, $order->status);
    }

    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('orders.destroy', $order));

        $response->assertRedirect(route('orders.index'));

        $this->assertModelMissing($order);
    }
}
