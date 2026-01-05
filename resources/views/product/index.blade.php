@extends('layouts.public')

@section('content')
<div class="text-center mb-5">
    <h1 class="display-4">Katalog</h1> 
    
    <div class="btn-group mt-3 flex-wrap" role="group">
        <a href="{{ route('products.index') }}" 
           class="btn {{ !request('material_id') ? 'btn-success' : 'btn-outline-secondary' }}">
           Sve
        </a>

        @foreach($materials as $material)
            <a href="{{ route('products.index', ['material_id' => $material->id]) }}" 
               class="btn {{ request('material_id') == $material->id ? 'btn-success' : 'btn-outline-secondary' }}">
               {{ $material->name }}
            </a>
        @endforeach
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
    @foreach($products as $product)
    <div class="col" style="max-width: 300px;">
        <div class="card h-100 text-center shadow-sm border-0 product-card">
            
            <div class="image-container">
                <img src="{{ $product->image_path }}" 
                     class="card-img p-3" 
                     alt="{{ $product->name }}">
                
                <div class="product-overlay">
                    <div class="overlay-text">
                        <p class="mb-0 fw-medium">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <h5 class="card-title h6 fw-bold mb-1">{{ $product->name }}</h5>
                <p class="card-text text-success fw-bold small mb-0">{{ number_format($product->price, 2) }} RSD</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

<style>
    .product-card {
        overflow: hidden;
        cursor: default; /* Kursor ostaje obična strelica, ne "ruka" za klik */
    }

    .image-container {
        position: relative;
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }

    .image-container img {
        max-height: 100%;
        width: auto;
        object-fit: contain;
    }

    /* Overlay sa opisom */
    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(40, 167, 69, 0.92); /* Malo jača zelena radi čitljivosti */
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        padding: 20px;
    }

    .overlay-text {
        color: white;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    /* Hover efekat: samo prikazujemo opis, bez mrdanja kartice */
    .product-card:hover .product-overlay {
        opacity: 1;
    }
</style>