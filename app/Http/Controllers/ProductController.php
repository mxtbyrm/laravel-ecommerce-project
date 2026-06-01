<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('q')->trim();
        $categorySlug = $request->string('category')->toString();

        $activeCategory = $categorySlug !== ''
            ? Category::where('slug', $categorySlug)->first()
            : null;

        $products = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->when($activeCategory, fn ($query) => $query->where('category_id', $activeCategory->id))
            ->when($search->isNotEmpty(), function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'ilike', "%{$search}%")
                      ->orWhere('description', 'ilike', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('products.index', [
            'products' => $products,
            'search' => $search,
            'categories' => Category::orderBy('name')->get(),
            'activeCategory' => $activeCategory,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load('category');

        $related = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, fn ($q) => $q->where('category_id', $product->category_id))
            ->take(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'related' => $related,
        ]);
    }
}
