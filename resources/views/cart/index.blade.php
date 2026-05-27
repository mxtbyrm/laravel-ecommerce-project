@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<h1 class="h3 mb-4">Your Cart</h1>

@if ($items->isEmpty())
    <div class="alert alert-info">
        Your cart is empty. <a href="{{ route('products.index') }}">Continue shopping</a>.
    </div>
@else
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th class="text-end">Price</th>
                                <th style="width: 140px;">Qty</th>
                                <th class="text-end">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                @php($product = $item['product'])
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $product->image ?: 'https://placehold.co/60x60?text=—' }}"
                                                 alt="" width="48" height="48" class="rounded" style="object-fit: cover;">
                                            <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
                                                {{ $product->name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-end">${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.update', $product) }}" class="d-flex gap-1">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                   min="1" max="{{ $product->stock }}" class="form-control form-control-sm">
                                            <button class="btn btn-sm btn-outline-secondary" title="Update">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-end">${{ number_format($item['subtotal'], 2) }}</td>
                                    <td class="text-end">
                                        <form method="POST" action="{{ route('cart.remove', $product) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Remove">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Summary</h2>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span class="fw-bold">${{ number_format($total, 2) }}</span>
                    </div>
                    <p class="text-muted small">Shipping calculated at checkout.</p>
                    @auth
                        <a href="{{ route('checkout.show') }}" class="btn btn-dark w-100">
                            Proceed to checkout
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-dark w-100">Login to checkout</a>
                    @endauth
                    <a href="{{ route('products.index') }}" class="btn btn-link w-100 mt-2">Continue shopping</a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
