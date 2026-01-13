<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentStoreRequest;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::all();

        return view('appointment.index', [
            'appointments' => $appointments,
        ]);
    }

    public function create(Request $request)
    {
        $services = Service::all();

        return view('appointment.create', compact('services'));
    }

    public function store(AppointmentStoreRequest $request)
    {

        $data = $request->validated();

        $data['user_id'] = auth()->id();

        $appointment = Appointment::create($data);

        return redirect()->route('appointments.my')->with('success', 'Termin je uspešno zakazan!');
    }

    public function show(Request $request, Appointment $appointment)
    {
        return view('appointment.show', [
            'appointment' => $appointment,
        ]);
    }

    public function edit(Appointment $appointment)
    {
        // Provera: Korisnik ne sme da menja tuđe termine
        if ($appointment->user_id !== auth()->id()) {
            abort(403, 'Nemate dozvolu da menjate ovaj termin.');
        }

        $services = \App\Models\Service::all();

        return view('appointment.edit', compact('appointment', 'services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'client_name' => 'required|string|max:150',
            'client_phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.my')->with('success', 'Termin uspešno ažuriran!');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        $appointment->delete();

        return redirect()->route('appointments.my')->with('success', 'Termin uspešno otkazan.');
    }

    public function myAppointments()
    {

        $appointments = auth()->user()->appointments()->latest()->get();

        return view('appointment.my_appointments', compact('appointments'));
    }
}
