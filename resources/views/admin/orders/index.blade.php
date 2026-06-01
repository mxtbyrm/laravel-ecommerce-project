@extends('layouts.admin')

@section('title', 'Orders')
@section('heading', 'Orders')

@section('content')
<div class="d-flex flex-wrap gap-2 mb-3">
    <a href="{{ route('admin.orders.index') }}"
       class="btn btn-sm {{ $currentStatus === '' ? 'btn-dark' : 'btn-outline-dark' }}">All</a>
    @foreach ($statuses as $status)
        <a href="{{ route('admin.orders.index', ['status' => $status]) }}"
           class="btn btn-sm text-capitalize {{ $currentStatus === $status ? 'btn-dark' : 'btn-outline-dark' }}">
            {{ $status }}
        </a>
    @endforeach
</div>

@if ($orders->isEmpty())
    <div class="alert alert-info">No orders found.</div>
@else
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th class="text-end">Items</th>
                        <th>Status</th>
                        <th class="text-end">Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                {{ $order->user?->name ?? $order->shipping_name }}
                                <div class="text-muted small">{{ $order->shipping_email }}</div>
                            </td>
                            <td>{{ $order->created_at->format('M j, Y') }}</td>
                            <td class="text-end">{{ $order->items_count }}</td>
                            <td><span class="badge bg-secondary-subtle text-secondary-emphasis text-capitalize">{{ $order->status }}</span></td>
                            <td class="text-end">${{ number_format($order->total, 2) }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
@endif
@endsection
