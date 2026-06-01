@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <h1 class="h3 mb-0">
        {{ $activeCategory?->name ?? 'Shop' }}
    </h1>
    <form method="GET" action="{{ route('products.index') }}" class="d-flex" style="max-width: 320px;">
        @if ($activeCategory)
            <input type="hidden" name="category" value="{{ $activeCategory->slug }}">
        @endif
        <input type="search" name="q" value="{{ $search }}" class="form-control me-2" placeholder="Search products...">
        <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
    </form>
</div>

<div class="row">
    <aside class="col-lg-3 mb-4">
        <div class="list-group shadow-sm">
            <a href="{{ route('products.index', ['q' => $search ?: null]) }}"
               class="list-group-item list-group-item-action {{ $activeCategory ? '' : 'active' }}">
                All products
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug, 'q' => $search ?: null]) }}"
                   class="list-group-item list-group-item-action {{ $activeCategory?->id === $category->id ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </aside>

    <div class="col-lg-9">
        @if ($products->isEmpty())
            <div class="alert alert-info">No products found{{ filled($search) ? ' for "'.$search.'"' : '' }}.</div>
        @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('products.show', $product) }}">
                                <img src="{{ $product->image ?: 'https://placehold.co/600x400?text=No+Image' }}"
                                     class="card-img-top" alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
                            </a>
                            <div class="card-body d-flex flex-column">
                                @if ($product->category)
                                    <span class="badge bg-info-subtle text-info-emphasis align-self-start mb-1">{{ $product->category->name }}</span>
                                @endif
                                <h2 class="h6">
                                    <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark stretched-link">
                                        {{ $product->name }}
                                    </a>
                                </h2>
                                <p class="text-muted small flex-grow-1">{{ Str::limit($product->description, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                    @if ($product->stock > 0)
                                        <span class="badge bg-success-subtle text-success-emphasis">In stock</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger-emphasis">Sold out</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pb-3">
                                <form method="POST" action="{{ route('cart.add', $product) }}" class="position-relative">
                                    @csrf
                                    <button class="btn btn-dark w-100 btn-sm" @disabled($product->stock < 1)>
                                        <i class="bi bi-cart-plus"></i> Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
