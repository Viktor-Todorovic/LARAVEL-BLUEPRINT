@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Izmjeni materijal: {{ $material->name }}</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.materials.update', $material->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Naziv materijala</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $material->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Količina na zalihi (m)</label>
                            <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $material->stock_quantity) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Cijena po metru (RSD)</label>
                            <input type="number" step="0.01" name="price_per_meter" class="form-control" value="{{ old('price_per_meter', $material->price_per_meter) }}" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.materials.index') }}" class="btn btn-outline-secondary">Odustani</a>
                            <button type="submit" class="btn btn-success px-4 fw-bold">Sačuvaj izmjene</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection