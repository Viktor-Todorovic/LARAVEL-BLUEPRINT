@extends('layouts.public')

@section('content')
<div class="container bg-white p-4 shadow-sm rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Upravljanje Proizvodima</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Dodaj novi proizvod
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Slika</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Cena</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
    @if($product->image_path)
        <img src="{{ asset($product->image_path) }}" 
             alt="{{ $product->name }}" 
             class="rounded shadow-sm" 
             style="width: 60px; height: 60px; object-fit: cover;">
    @else
        <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center shadow-sm" 
             style="width: 60px; height: 60px;">
            <i class="bi bi-image"></i>
        </div>
    @endif
</td>
                    <td class="fw-bold">{{ $product->name }}</td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td>{{ number_format($product->price, 2) }} RSD</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Jeste li sigurni da želite da obrišete ovaj proizvod?')">
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