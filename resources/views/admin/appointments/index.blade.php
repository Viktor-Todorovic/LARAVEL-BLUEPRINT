@extends('layouts.public')

@section('content')
<div class="container bg-white p-4 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Upravljanje Terminima</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Klijent</th>
                    <th>Telefon</th>
                    <th>Datum i Vrijeme</th>
                    <th>Usluga</th> <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->client_name }}</td>
                    <td>{{ $appointment->client_phone }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d.m.Y. H:i') }}</td>
                    
                    <td>
                        <span>
                            {{ $appointment->service->name ?? 'Nepoznata usluga' }}
                        </span>
                    </td>

                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            
                            <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Jeste li sigurni?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection