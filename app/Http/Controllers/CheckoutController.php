<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(private readonly Cart $cart)
    {
    }

    public function show(Request $request): View|RedirectResponse
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty.');
        }

        return view('checkout.show', [
            'items' => $this->cart->items(),
            'total' => $this->cart->total(),
            'user' => $request->user(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_email' => ['required', 'email', 'max:255'],
            'shipping_address' => ['required', 'string', 'max:1000'],
        ]);

        $items = $this->cart->items();

        $order = DB::transaction(function () use ($request, $validated, $items) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'status' => 'paid', // mock checkout: instantly "paid"
                'total' => $this->cart->total(),
                'shipping_name' => $validated['shipping_name'],
                'shipping_email' => $validated['shipping_email'],
                'shipping_address' => $validated['shipping_address'],
            ]);

            foreach ($items as $item) {
                /** @var \App\Models\Product $product */
                $product = $item['product'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                ]);

                // Decrement stock for the purchased quantity.
                $product->decrement('stock', min($item['quantity'], $product->stock));
            }

            return $order;
        });

        $this->cart->clear();

        return redirect()->route('orders.show', $order)
            ->with('status', 'Thank you! Your order has been placed.');
    }
}
