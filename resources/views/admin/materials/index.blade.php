@extends('layouts.public')

@section('content')
<div class="container bg-white p-4 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Upravljanje Materijalima</h2>
        <a href="{{ route('admin.materials.create') }}" class="btn btn-success">Dodaj novi materijal</a>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Naziv materijala</th>
                <th>Kolicina</th>
                <th>Cena po metru</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
            <tr>
                <td class="fw-bold">{{ $material->name }}</td>
                <td>{{ $material->stock_quantity ?? 'Nema dostupnih' }}</td>
                <td>{{ $material->price_per_meter}} RSD</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('admin.materials.edit', $material->id) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                        <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Sigurno?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection