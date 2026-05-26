<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class Cart
{
    private const SESSION_KEY = 'cart';

    /**
     * Raw cart data keyed by product id: [product_id => quantity].
     *
     * @return array<int, int>
     */
    private function raw(): array
    {
        return session(self::SESSION_KEY, []);
    }

    private function save(array $items): void
    {
        session([self::SESSION_KEY => $items]);
    }

    public function add(Product $product, int $quantity = 1): void
    {
        $items = $this->raw();
        $current = $items[$product->id] ?? 0;
        $items[$product->id] = max(1, min($current + $quantity, $product->stock));
        $this->save($items);
    }

    public function update(Product $product, int $quantity): void
    {
        $items = $this->raw();

        if ($quantity <= 0) {
            unset($items[$product->id]);
        } else {
            $items[$product->id] = min($quantity, $product->stock);
        }

        $this->save($items);
    }

    public function remove(int $productId): void
    {
        $items = $this->raw();
        unset($items[$productId]);
        $this->save($items);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * Total number of units across all line items.
     */
    public function count(): int
    {
        return array_sum($this->raw());
    }

    /**
     * Resolved line items: each with the Product model and quantity.
     *
     * @return Collection<int, array{product: Product, quantity: int, subtotal: float}>
     */
    public function items(): Collection
    {
        $items = $this->raw();

        if (empty($items)) {
            return collect();
        }

        return Product::whereIn('id', array_keys($items))
            ->get()
            ->map(fn (Product $product) => [
                'product' => $product,
                'quantity' => $items[$product->id],
                'subtotal' => (float) $product->price * $items[$product->id],
            ])
            ->values();
    }

    public function total(): float
    {
        return (float) $this->items()->sum('subtotal');
    }

    public function isEmpty(): bool
    {
        return empty($this->raw());
    }
}
