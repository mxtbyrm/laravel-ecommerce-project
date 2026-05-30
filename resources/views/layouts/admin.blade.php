<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') · {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; }
        .admin-sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1e293b;
        }
        .admin-sidebar .nav-link {
            color: #cbd5e1;
            border-radius: .5rem;
            margin-bottom: .15rem;
        }
        .admin-sidebar .nav-link:hover { background: #334155; color: #fff; }
        .admin-sidebar .nav-link.active { background: #0d6efd; color: #fff; }
        .admin-sidebar .nav-link i { width: 1.25rem; }
        @media (max-width: 768px) {
            .admin-sidebar { width: 100%; min-height: auto; }
        }
    </style>
</head>
<body class="bg-body-tertiary">
<div class="d-md-flex">
    <aside class="admin-sidebar p-3 d-flex flex-column">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand text-white fw-bold mb-3 px-2">
            <i class="bi bi-speedometer2 me-1"></i> Admin
        </a>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="{{ route('admin.dashboard') }}" class="nav-link @active('admin.dashboard')"><i class="bi bi-grid-1x2"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.categories.index') }}" class="nav-link @active('admin.categories.*')"><i class="bi bi-tags"></i> Categories</a></li>
            <li><a href="{{ route('admin.products.index') }}" class="nav-link @active('admin.products.*')"><i class="bi bi-box-seam"></i> Products</a></li>
            <li><a href="{{ route('admin.orders.index') }}" class="nav-link @active('admin.orders.*')"><i class="bi bi-receipt"></i> Orders</a></li>
        </ul>
        <hr class="text-secondary">
        <a href="{{ route('home') }}" class="nav-link"><i class="bi bi-shop"></i> View store</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="nav-link border-0 bg-transparent w-100 text-start"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>
    </aside>

    <main class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">@yield('heading', 'Dashboard')</h1>
            <span class="text-muted small"><i class="bi bi-person-circle"></i> {{ auth()->user()->name }}</span>
        </div>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
