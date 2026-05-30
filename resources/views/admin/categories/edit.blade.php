@extends('layouts.admin')

@section('title', 'Edit Category')
@section('heading', 'Edit Category')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            @include('admin.categories._form', ['submitLabel' => 'Save changes'])
        </form>
    </div>
</div>
@endsection
