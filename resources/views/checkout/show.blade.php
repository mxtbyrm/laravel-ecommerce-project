@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<h1 class="h3 mb-4">Checkout</h1>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3">Shipping details</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('checkout.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="shipping_name">Full name</label>
                        <input id="shipping_name" name="shipping_name" class="form-control"
                               value="{{ old('shipping_name', $user->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="shipping_email">Email</label>
                        <input id="shipping_email" type="email" name="shipping_email" class="form-control"
                               value="{{ old('shipping_email', $user->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="shipping_address">Shipping address</label>
                        <textarea id="shipping_address" name="shipping_address" class="form-control" rows="3"
                                  required>{{ old('shipping_address') }}</textarea>
                    </div>

                    <div class="alert alert-secondary small">
                        <i class="bi bi-info-circle"></i> This is a demo store — no real payment is processed.
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-lock"></i> Place order &middot; ${{ number_format($total, 2) }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3">Order summary</h2>
                <ul class="list-group list-group-flush">
                    @foreach ($items as $item)
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>{{ $item['product']->name }} &times; {{ $item['quantity'] }}</span>
                            <span>${{ number_format($item['subtotal'], 2) }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between px-0 fw-bold">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
