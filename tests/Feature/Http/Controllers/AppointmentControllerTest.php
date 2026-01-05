<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentControllerTest extends TestCase
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
        Appointment::factory()->count(3)->create();
        $response = $this->actingAs($this->user)->get(route('appointments.index'));
        $response->assertOk();
        $response->assertViewHas('appointments');
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $service = Service::factory()->create();
        $client_name = 'Test Klijent';

        $response = $this->actingAs($this->user)->post(route('appointments.store'), [
            'client_name' => $client_name,
            'client_phone' => '123456789',
            'service_id' => $service->id,
            'appointment_date' => now()->addDay()->format('Y-m-d H:i:s'),
            'user_id' => $this->user->id,
            'status' => 'pending',
        ]);

        $response->assertRedirect(route('appointments.index'));
        $this->assertDatabaseHas('appointments', ['client_name' => $client_name]);
    }

    #[Test]
    public function update_redirects(): void
    {
        $appointment = Appointment::factory()->create();
        $new_name = 'Izmenjeno Ime';

        $response = $this->actingAs($this->user)->put(route('appointments.update', $appointment), [
            'client_name' => $new_name,
            'client_phone' => '000000',
            'service_id' => $appointment->service_id,
            'appointment_date' => $appointment->appointment_date,
            'user_id' => $this->user->id,
            'status' => 'confirmed',
        ]);

        $response->assertRedirect(route('appointments.index'));
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'client_name' => $new_name,
        ]);
    }

    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $appointment = Appointment::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('appointments.destroy', $appointment));
        $response->assertRedirect(route('appointments.index'));
        $this->assertModelMissing($appointment);
    }
}
