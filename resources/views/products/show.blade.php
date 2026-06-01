@extends('layouts.app')

@section('title', $product->name)

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Shop</a></li>
        @if ($product->category)
            <li class="breadcrumb-item">
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
            </li>
        @endif
        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-md-6">
        <img src="{{ $product->image ?: 'https://placehold.co/600x400?text=No+Image' }}"
             class="img-fluid rounded shadow-sm w-100" alt="{{ $product->name }}" style="object-fit: cover;">
    </div>
    <div class="col-md-6">
        @if ($product->category)
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
               class="badge bg-info-subtle text-info-emphasis text-decoration-none mb-2">{{ $product->category->name }}</a>
        @endif
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

@if ($related->isNotEmpty())
    <hr class="my-5">
    <h2 class="h4 mb-3">You might also like</h2>
    <div class="row row-cols-2 row-cols-lg-4 g-4">
        @foreach ($related as $item)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('products.show', $item) }}">
                        <img src="{{ $item->image ?: 'https://placehold.co/600x400?text=No+Image' }}"
                             class="card-img-top" alt="{{ $item->name }}" style="height: 150px; object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <h3 class="h6 mb-1">
                            <a href="{{ route('products.show', $item) }}" class="text-decoration-none text-dark stretched-link">
                                {{ $item->name }}
                            </a>
                        </h3>
                        <span class="fw-bold">${{ number_format($item->price, 2) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
