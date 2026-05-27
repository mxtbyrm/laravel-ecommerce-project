<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private readonly Cart $cart)
    {
    }

    public function index(): View
    {
        return view('cart.index', [
            'items' => $this->cart->items(),
            'total' => $this->cart->total(),
        ]);
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $quantity = (int) $request->input('quantity', 1);

        if ($product->stock < 1) {
            return back()->with('error', "{$product->name} is out of stock.");
        }

        $this->cart->add($product, max(1, $quantity));

        return back()->with('status', "{$product->name} added to your cart.");
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $this->cart->update($product, (int) $request->input('quantity', 1));

        return back()->with('status', 'Cart updated.');
    }

    public function remove(Product $product): RedirectResponse
    {
        $this->cart->remove($product->id);

        return back()->with('status', 'Item removed from cart.');
    }
}
