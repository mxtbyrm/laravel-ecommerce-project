@extends('layouts.admin')

@section('title', 'Order #'.$order->id)
@section('heading', 'Order #'.$order->id)

@section('content')
<a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Back to orders
</a>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Items</span>
                <span class="badge bg-secondary-subtle text-secondary-emphasis text-capitalize">{{ $order->status }}</span>
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
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">Update status</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="d-flex gap-2">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select text-capitalize">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected($order->status === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Customer</div>
            <div class="card-body">
                <p class="mb-1">{{ $order->shipping_name }}</p>
                <p class="mb-1 text-muted small">{{ $order->shipping_email }}</p>
                <p class="mb-2 text-muted">{{ $order->shipping_address }}</p>
                <hr>
                <p class="text-muted small mb-0">
                    Account: {{ $order->user?->email ?? 'guest' }}<br>
                    Placed {{ $order->created_at->format('M j, Y \a\t g:i A') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
