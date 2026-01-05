<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Prikaz svih termina
    public function index()
    {
        $appointments = Appointment::orderBy('appointment_date', 'asc')->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    // Forma za editovanje
    public function edit(Appointment $appointment)
    {
        // Povlačimo sve usluge iz baze
        $services = Service::all();

        return view('admin.appointments.edit', compact('appointment', 'services'));
    }

    // Update termina
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'service_id' => 'required|integer',
            'appointment_date' => 'required|date',
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Termin za klijenta '.$appointment->client_name.' je uspešno izmenjen.');
    }

    // Brisanje termina
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'Termin obrisan.');
    }
}
