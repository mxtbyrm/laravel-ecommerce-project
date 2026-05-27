@extends('layouts.app')

@section('title', 'Admin · Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Manage Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg"></i> New product
    </a>
</div>

@if ($products->isEmpty())
    <div class="alert alert-info">No products yet. Create your first one.</div>
@else
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Stock</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->image ?: 'https://placehold.co/48x48?text=—' }}"
                                     alt="" width="48" height="48" class="rounded" style="object-fit: cover;">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td class="text-end">${{ number_format($product->price, 2) }}</td>
                            <td class="text-end">{{ $product->stock }}</td>
                            <td>
                                @if ($product->is_active)
                                    <span class="badge bg-success-subtle text-success-emphasis">Active</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis">Hidden</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="d-inline"
                                      onsubmit="return confirm('Delete {{ $product->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
@endif
@endsection
