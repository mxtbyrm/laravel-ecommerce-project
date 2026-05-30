<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::count(),
                'orders' => Order::count(),
                'customers' => User::where('is_admin', false)->count(),
                'revenue' => (float) Order::where('status', '!=', 'cancelled')->sum('total'),
            ],
            'recentOrders' => Order::with('user')->latest()->take(5)->get(),
            'lowStock' => Product::where('stock', '<=', 30)->orderBy('stock')->take(5)->get(),
        ]);
    }
}
