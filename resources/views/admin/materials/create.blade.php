@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Dodaj novi materijal</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.materials.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Naziv materijala</label>
                            <input type="text" name="name" class="form-control" placeholder="npr. Vuna" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Količina na zalihi (m)</label>
                            <input type="number" name="stock_quantity" class="form-control" placeholder="npr. 50" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cijena po metru (RSD)</label>
                            <input type="number" step="0.01" name="price_per_meter" class="form-control" placeholder="npr. 2500" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-bold">Sačuvaj materijal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection