@extends('layouts.admin')

@section('title', 'New Category')
@section('heading', 'New Category')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            @include('admin.categories._form', ['submitLabel' => 'Create category'])
        </form>
    </div>
</div>
@endsection
