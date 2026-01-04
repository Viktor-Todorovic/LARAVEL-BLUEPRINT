@extends('layouts.public')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        
        
        <h4>Zakazi termin</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Ime:</label> <input type="text" name="client_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Broj telefona:</label> <input type="text" name="client_phone" class="form-control" required>
            </div>

            <div class="mb-3">
    <label class="form-label">Usluga:</label>
    <select name="service_id" class="form-select" required>
        <option value="" selected disabled>Izaberite uslugu...</option>
        @foreach($services as $service)
            <option value="{{ $service->id }}">{{ $service->name }}</option>
        @endforeach
    </select>
    @error('service_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
            
            <div class="mb-3">
                <label class="form-label">Datum:</label> <input type="date" name="appointment_date" class="form-control" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-lg">Zakazi termin</button> </div>
        </form>
            
        
    </div>
</div>
@endsection