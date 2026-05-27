@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<h1 class="h3 mb-4">My Orders</h1>

@if ($orders->isEmpty())
    <div class="alert alert-info">
        You haven't placed any orders yet. <a href="{{ route('products.index') }}">Start shopping</a>.
    </div>
@else
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th class="text-end">Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('M j, Y') }}</td>
                            <td>{{ $order->items_count }}</td>
                            <td><span class="badge bg-success-subtle text-success-emphasis text-capitalize">{{ $order->status }}</span></td>
                            <td class="text-end">${{ number_format($order->total, 2) }}</td>
                            <td class="text-end">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-dark">View</a>
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
