@extends('layouts.app')

@section('title', 'Admin · New Product')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
        <li class="breadcrumb-item active">New</li>
    </ol>
</nav>

<h1 class="h3 mb-4">New Product</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            @include('admin.products._form', ['submitLabel' => 'Create product'])
        </form>
    </div>
</div>
@endsection
