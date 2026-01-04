@extends('layouts.app')

@section('content')
<div class="text-center mb-5">
    <h1 class="display-4">Katalog</h1> <div class="btn-group mt-3" role="group">
        <button type="button" class="btn btn-outline-secondary">Majice</button> <button type="button" class="btn btn-outline-secondary">Dukserice</button> <button type="button" class="btn btn-outline-secondary">Košulje</button> </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($products as $product)
    <div class="col">
        <div class="card h-100 text-center shadow-sm">
            <img src="{{ $product->image_path }}" class="card-img-top p-3" alt="Proizvod"> <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text text-muted">{{ $product->price }} RSD</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection