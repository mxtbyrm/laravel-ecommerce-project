@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="text-muted small text-uppercase">Revenue</div>
                <div class="h3 mb-0">${{ number_format($stats['revenue'], 2) }}</div>
                <i class="bi bi-cash-stack text-success fs-3"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="text-muted small text-uppercase">Orders</div>
                <div class="h3 mb-0">{{ $stats['orders'] }}</div>
                <i class="bi bi-receipt text-primary fs-3"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="text-muted small text-uppercase">Products</div>
                <div class="h3 mb-0">{{ $stats['products'] }}</div>
                <i class="bi bi-box-seam text-warning fs-3"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="text-muted small text-uppercase">Customers</div>
                <div class="h3 mb-0">{{ $stats['customers'] }}</div>
                <i class="bi bi-people text-info fs-3"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Recent orders</span>
                <a href="{{ route('admin.orders.index') }}" class="small">View all</a>
            </div>
            @if ($recentOrders->isEmpty())
                <div class="card-body text-muted">No orders yet.</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr><th>#</th><th>Customer</th><th>Status</th><th class="text-end">Total</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $order)
                                <tr>
                                    <td><a href="{{ route('admin.orders.show', $order) }}">#{{ $order->id }}</a></td>
                                    <td>{{ $order->user?->name ?? $order->shipping_name }}</td>
                                    <td><span class="badge bg-secondary-subtle text-secondary-emphasis text-capitalize">{{ $order->status }}</span></td>
                                    <td class="text-end">${{ number_format($order->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Low stock</div>
            @if ($lowStock->isEmpty())
                <div class="card-body text-muted">All products well stocked.</div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($lowStock as $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-decoration-none">{{ $product->name }}</a>
                            <span class="badge {{ $product->stock <= 10 ? 'bg-danger' : 'bg-warning text-dark' }}">{{ $product->stock }} left</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
