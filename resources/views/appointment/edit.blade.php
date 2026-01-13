@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-success text-white p-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>Izmeni termin br: #{{ $appointment->id }}
                    </h4>
                </div>

                <div class="card-body p-4 bg-white">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="client_name" class="form-label fw-bold">Ime i prezime klijenta</label>
                                <input type="text" name="client_name" id="client_name" class="form-control" 
                                       value="{{ old('client_name', $appointment->client_name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="client_phone" class="form-label fw-bold">Broj telefona</label>
                                <input type="text" name="client_phone" id="client_phone" class="form-control" 
                                       value="{{ old('client_phone', $appointment->client_phone) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="service_id" class="form-label fw-bold">Usluga</label>
                                <select name="service_id" id="service_id" class="form-select" required>
                                    <option value="" disabled>Izaberite uslugu...</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" 
                                            {{ (old('service_id', $appointment->service_id) == $service->id) ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="appointment_date" class="form-label fw-bold">Datum termina</label>
                                <input type="date" name="appointment_date" id="appointment_date" class="form-control" 
                                       value="{{ old('appointment_date', \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('appointments.my') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-1"></i> Nazad na listu
                            </a>
                            <button type="submit" class="btn btn-success px-5 fw-bold text-white">
                                <i class="bi bi-save me-1"></i> Sačuvaj izmene
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
</style>
@endsection