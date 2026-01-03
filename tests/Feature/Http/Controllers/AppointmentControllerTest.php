<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AppointmentController
 */
final class AppointmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $appointments = Appointment::factory()->count(3)->create();

        $response = $this->get(route('appointments.index'));

        $response->assertOk();
        $response->assertViewIs('appointment.index');
        $response->assertViewHas('appointments', $appointments);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('appointments.create'));

        $response->assertOk();
        $response->assertViewIs('appointment.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AppointmentController::class,
            'store',
            \App\Http\Requests\AppointmentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();
        $appointment_date = Carbon::parse(fake()->dateTime());
        $status = fake()->word();

        $response = $this->post(route('appointments.store'), [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'appointment_date' => $appointment_date->toDateTimeString(),
            'status' => $status,
        ]);

        $appointments = Appointment::query()
            ->where('user_id', $user->id)
            ->where('service_id', $service->id)
            ->where('appointment_date', $appointment_date)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $appointments);
        $appointment = $appointments->first();

        $response->assertRedirect(route('appointments.index'));
        $response->assertSessionHas('appointment.id', $appointment->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $appointment = Appointment::factory()->create();

        $response = $this->get(route('appointments.show', $appointment));

        $response->assertOk();
        $response->assertViewIs('appointment.show');
        $response->assertViewHas('appointment', $appointment);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $appointment = Appointment::factory()->create();

        $response = $this->get(route('appointments.edit', $appointment));

        $response->assertOk();
        $response->assertViewIs('appointment.edit');
        $response->assertViewHas('appointment', $appointment);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AppointmentController::class,
            'update',
            \App\Http\Requests\AppointmentUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $appointment = Appointment::factory()->create();
        $user = User::factory()->create();
        $service = Service::factory()->create();
        $appointment_date = Carbon::parse(fake()->dateTime());
        $status = fake()->word();

        $response = $this->put(route('appointments.update', $appointment), [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'appointment_date' => $appointment_date->toDateTimeString(),
            'status' => $status,
        ]);

        $appointment->refresh();

        $response->assertRedirect(route('appointments.index'));
        $response->assertSessionHas('appointment.id', $appointment->id);

        $this->assertEquals($user->id, $appointment->user_id);
        $this->assertEquals($service->id, $appointment->service_id);
        $this->assertEquals($appointment_date, $appointment->appointment_date);
        $this->assertEquals($status, $appointment->status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $appointment = Appointment::factory()->create();

        $response = $this->delete(route('appointments.destroy', $appointment));

        $response->assertRedirect(route('appointments.index'));

        $this->assertModelMissing($appointment);
    }
}
