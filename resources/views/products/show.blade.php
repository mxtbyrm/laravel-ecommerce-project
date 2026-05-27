@extends('layouts.app')

@section('title', $product->name)

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Shop</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-md-6">
        <img src="{{ $product->image ?: 'https://placehold.co/600x400?text=No+Image' }}"
             class="img-fluid rounded shadow-sm w-100" alt="{{ $product->name }}" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
        <h1 class="h3">{{ $product->name }}</h1>
        <p class="display-6 fw-bold">${{ number_format($product->price, 2) }}</p>

        @if ($product->stock > 0)
            <p class="text-success"><i class="bi bi-check-circle"></i> {{ $product->stock }} in stock</p>
        @else
            <p class="text-danger"><i class="bi bi-x-circle"></i> Out of stock</p>
        @endif

        <p class="text-muted">{{ $product->description }}</p>

        <form method="POST" action="{{ route('cart.add', $product) }}" class="d-flex gap-2 align-items-end mt-4" style="max-width: 320px;">
            @csrf
            <div>
                <label for="quantity" class="form-label small mb-1">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                       class="form-control" style="width: 100px;" @disabled($product->stock < 1)>
            </div>
            <button class="btn btn-dark" @disabled($product->stock < 1)>
                <i class="bi bi-cart-plus"></i> Add to cart
            </button>
        </form>
    </div>
</div>
@endsection
