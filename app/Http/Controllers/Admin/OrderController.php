<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Allowed order statuses for the admin status dropdown.
     */
    public const STATUSES = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];

    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();

        $orders = Order::with('user')
            ->withCount('items')
            ->when(in_array($status, self::STATUSES, true), fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => self::STATUSES,
            'currentStatus' => $status,
        ]);
    }

    public function show(Order $order): View
    {
        $order->load('items', 'user');

        return view('admin.orders.show', [
            'order' => $order,
            'statuses' => self::STATUSES,
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:'.implode(',', self::STATUSES)],
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.show', $order)
            ->with('status', 'Order status updated to '.$validated['status'].'.');
    }
}
