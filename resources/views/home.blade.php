@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="p-5 mb-5 rounded-3 text-white position-relative overflow-hidden"
     style="background: linear-gradient(120deg, #0d6efd, #6610f2);">
    <div class="row align-items-center">
        <div class="col-lg-7">
            <h1 class="display-5 fw-bold">Shop the essentials you'll love</h1>
            <p class="lead mb-4">
                Quality clothing, footwear, accessories and electronics — all in one place,
                at prices that make sense.
            </p>
            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg">
                <i class="bi bi-bag"></i> Browse the shop
            </a>
        </div>
        <div class="col-lg-5 text-center d-none d-lg-block">
            <i class="bi bi-bag-heart-fill" style="font-size: 9rem; opacity: .35;"></i>
        </div>
    </div>
</div>

@if ($categories->isNotEmpty())
    <h2 class="h4 mb-3">Shop by category</h2>
    <div class="row row-cols-2 row-cols-md-4 g-3 mb-5">
        @foreach ($categories as $category)
            <div class="col">
                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                   class="card text-decoration-none text-dark h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <i class="bi bi-tag-fill fs-2 text-primary"></i>
                        <h3 class="h6 mt-2 mb-0">{{ $category->name }}</h3>
                        <small class="text-muted">{{ $category->products_count }} items</small>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">New arrivals</h2>
    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-dark">View all</a>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
    @foreach ($featured as $product)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <a href="{{ route('products.show', $product) }}">
                    <img src="{{ $product->image ?: 'https://placehold.co/600x400?text=No+Image' }}"
                         class="card-img-top" alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
                </a>
                <div class="card-body d-flex flex-column">
                    <h3 class="h6">
                        <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark stretched-link">
                            {{ $product->name }}
                        </a>
                    </h3>
                    <span class="fw-bold mt-auto">${{ number_format($product->price, 2) }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
