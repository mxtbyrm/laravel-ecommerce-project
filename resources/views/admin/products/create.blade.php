@extends('layouts.admin')

@section('title', 'New Product')
@section('heading', 'New Product')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            @include('admin.products._form', ['submitLabel' => 'Create product'])
        </form>
    </div>
</div>
@endsection
