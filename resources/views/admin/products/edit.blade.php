@extends('layouts.public')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-success text-white p-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>Izmeni proizvod: {{ $product->name }}
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

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">Naziv proizvoda</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-bold">Cena (RSD)</label>
                                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="material_id" class="form-label fw-bold">Materijal</label>
                            <select name="material_id" id="material_id" class="form-select" required>
                                <option value="" disabled>Izaberite materijal...</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" {{ (old('material_id', $product->material_id) == $material->id) ? 'selected' : '' }}>
                                        {{ $material->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Opis</label>
                            <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">Slika proizvoda</label>
                            
                            <div class="d-flex align-items-start gap-3 mb-3">
                                @if($product->image)
                                    <div class="text-center">
                                        <small class="d-block text-muted mb-1">Trenutna slika:</small>
                                        <img src="{{ asset('images/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="rounded shadow-sm border" 
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                    </div>
                                @endif

                                <div class="flex-grow-1">
                                    <small class="d-block text-muted mb-1">Otpremite novu sliku (opciono):</small>
                                    <input type="file" name="image" class="form-control">
                                    <div class="form-text">Podržani formati: JPG, PNG, JPEG. Max 2MB.</div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left me-1"></i> Odustani
                            </a>
                            <button type="submit" class="btn btn-success px-5 fw-bold">
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
</style>
@endsection