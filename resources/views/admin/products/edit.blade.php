@extends('layouts.admin')

@section('title', 'Edit Product')
@section('heading', 'Edit Product')

@section('content')
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
