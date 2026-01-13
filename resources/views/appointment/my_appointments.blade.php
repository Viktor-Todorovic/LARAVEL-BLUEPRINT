@extends('layouts.public')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-success text-white py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-calendar-check"></i> Moji zakazani termini</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($appointments->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-calendar-x display-1 text-muted"></i>
                <p class="mt-3 lead">Nemate zakazanih termina.</p>
                <a href="{{ route('appointments.create') }}" class="btn btn-success">Zakaži svoj prvi termin</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Ime</th>
                            <th>Broj telefona</th>
                            <th>Datum</th>
                            <th>Usluga</th>
                            <th>Status</th>
                            <th class="text-center">Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->client_name }}</td>
                                <td>{{ $appointment->client_phone }}</td>
                                <td class="fw-bold">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d.m.Y.') }}</td>
                                <td>{{ $appointment->service->name ?? 'Nije definisano' }}</td>
                                <td><span class="badge bg-primary text-white">Zakazano</span></td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-warning text-white">
                                            <i class="bi bi-pencil-square"></i> Izmeni
                                        </a>

                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('Da li ste sigurni da želite da otkažete ovaj termin?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Otkaži
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection