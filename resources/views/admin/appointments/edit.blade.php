@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Izmeni termin: {{ $appointment->client_name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ime klijenta</label>
                            <input type="text" name="client_name" class="form-control" value="{{ $appointment->client_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Telefon</label>
                            <input type="text" name="client_phone" class="form-control" value="{{ $appointment->client_phone }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Datum i vreme</label>
                            <input type="datetime-local" 
                                   name="appointment_date" 
                                   class="form-control" 
                                   value="{{ date('Y-m-d\TH:i', strtotime($appointment->appointment_date)) }}" 
                                   required>
                        </div>

                        <div class="mb-3">
    <label for="service_id" class="form-label fw-bold">Usluga</label>
    <select name="service_id" id="service_id" class="form-select" required>
        <option value="" disabled>Izaberite uslugu...</option>
        @foreach($services as $service)
            <option value="{{ $service->id }}" 
                {{ $appointment->service_id == $service->id ? 'selected' : '' }}>
                {{ $service->name }}
            </option>
        @endforeach
    </select>
</div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary">Nazad</a>
                            <button type="submit" class="btn btn-success px-4">Ažuriraj termin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection