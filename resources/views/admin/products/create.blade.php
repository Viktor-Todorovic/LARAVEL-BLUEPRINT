@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Dodaj novi proizvod</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Naziv proizvoda</label>
                            <input type="text" name="name" class="form-control" placeholder="" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Opis</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Cena (RSD)</label>
                            <input type="number" name="price" class="form-control" placeholder="" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Materijal</label>
                            <select name="material_id" class="form-select" required>
                                <option value="" disabled selected>Izaberite materijal...</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Slika proizvoda</label>
                            <input type="file" name="image" class="form-control">
                            <div class="form-text">Slika će biti sačuvana u folderu images.</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4">Nazad</a>
                            <button type="submit" class="btn btn-success px-4 fw-bold">Sačuvaj proizvod</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection