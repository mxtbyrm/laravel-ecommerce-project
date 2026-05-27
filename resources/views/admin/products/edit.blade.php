@extends('layouts.app')

@section('title', 'Admin · Edit Product')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
</nav>

<h1 class="h3 mb-4">Edit Product</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.update', $product) }}">
            @csrf
            @method('PUT')
            @include('admin.products._form', ['submitLabel' => 'Save changes'])
        </form>
    </div>
</div>
@endsection
