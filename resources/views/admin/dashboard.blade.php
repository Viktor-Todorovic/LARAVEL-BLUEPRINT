@extends('layouts.public')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Admin Kontrolna Tabla</h2>
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="card shadow border-0 p-4">
                <i class="bi bi-box-seam display-4 text-success"></i>
                <h5 class="mt-3">Proizvodi</h5>
                <a href="{{ route('products.index') }}" class="btn btn-success mt-2">Upravljaj</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 p-4">
                <i class="bi bi-layers display-4 text-primary"></i>
                <h5 class="mt-3">Materijali</h5>
                <a href="#" class="btn btn-primary mt-2">Upravljaj</a>
            </div>
        </div>
        <div class="col-md-4">
    <div class="card shadow border-0 p-4 text-center">
        <i class="bi bi-calendar-check display-4 text-warning"></i>
        <h5 class="mt-3">Termini</h5>
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-warning mt-2 text-white">
            Prikaži sve termine
        </a>
    </div>
</div>
    </div>
</div>
@endsection