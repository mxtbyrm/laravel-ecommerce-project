@extends('layouts.app')

@section('title', 'Order #'.$order->id)

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">My Orders</a></li>
        <li class="breadcrumb-item active">Order #{{ $order->id }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-bold">Order #{{ $order->id }}</span>
                <span class="badge bg-success-subtle text-success-emphasis text-capitalize">{{ $order->status }}</span>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($order->items as $item)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ $item->product_name }} &times; {{ $item->quantity }}</span>
                        <span>${{ number_format($item->subtotal(), 2) }}</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span>${{ number_format($order->total, 2) }}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h6">Shipping to</h2>
                <p class="mb-1">{{ $order->shipping_name }}</p>
                <p class="mb-1 text-muted small">{{ $order->shipping_email }}</p>
                <p class="mb-0 text-muted">{{ $order->shipping_address }}</p>
                <hr>
                <p class="text-muted small mb-0">Placed {{ $order->created_at->format('M j, Y \a\t g:i A') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
