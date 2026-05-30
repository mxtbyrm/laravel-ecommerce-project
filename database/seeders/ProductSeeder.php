<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');

        $products = [
            [
                'name' => 'Classic White T-Shirt',
                'category' => 'clothing',
                'description' => 'A soft, breathable 100% cotton tee that goes with everything.',
                'price' => 19.99,
                'stock' => 120,
                'image' => 'https://picsum.photos/seed/tshirt/600/400',
            ],
            [
                'name' => 'Denim Jacket',
                'category' => 'clothing',
                'description' => 'Timeless denim jacket with a relaxed fit and sturdy stitching.',
                'price' => 79.90,
                'stock' => 40,
                'image' => 'https://picsum.photos/seed/jacket/600/400',
            ],
            [
                'name' => 'Running Sneakers',
                'category' => 'footwear',
                'description' => 'Lightweight sneakers with cushioned soles for all-day comfort.',
                'price' => 99.00,
                'stock' => 60,
                'image' => 'https://picsum.photos/seed/sneakers/600/400',
            ],
            [
                'name' => 'Leather Wallet',
                'category' => 'accessories',
                'description' => 'Genuine leather bifold wallet with RFID protection.',
                'price' => 34.50,
                'stock' => 75,
                'image' => 'https://picsum.photos/seed/wallet/600/400',
            ],
            [
                'name' => 'Wireless Headphones',
                'category' => 'electronics',
                'description' => 'Over-ear headphones with active noise cancellation and 30h battery.',
                'price' => 149.99,
                'stock' => 25,
                'image' => 'https://picsum.photos/seed/headphones/600/400',
            ],
            [
                'name' => 'Stainless Water Bottle',
                'category' => 'accessories',
                'description' => 'Insulated 750ml bottle that keeps drinks cold for 24 hours.',
                'price' => 24.00,
                'stock' => 200,
                'image' => 'https://picsum.photos/seed/bottle/600/400',
            ],
            [
                'name' => 'Canvas Backpack',
                'category' => 'accessories',
                'description' => 'Durable everyday backpack with a padded laptop compartment.',
                'price' => 59.95,
                'stock' => 50,
                'image' => 'https://picsum.photos/seed/backpack/600/400',
            ],
            [
                'name' => 'Analog Wristwatch',
                'category' => 'accessories',
                'description' => 'Minimalist wristwatch with a stainless steel mesh band.',
                'price' => 129.00,
                'stock' => 30,
                'image' => 'https://picsum.photos/seed/watch/600/400',
            ],
            [
                'name' => 'Bluetooth Speaker',
                'category' => 'electronics',
                'description' => 'Portable speaker with deep bass and 12-hour playtime.',
                'price' => 69.99,
                'stock' => 45,
                'image' => 'https://picsum.photos/seed/speaker/600/400',
            ],
            [
                'name' => 'Leather Sneakers',
                'category' => 'footwear',
                'description' => 'Premium leather sneakers with a minimalist design.',
                'price' => 119.00,
                'stock' => 35,
                'image' => 'https://picsum.photos/seed/leathershoe/600/400',
            ],
            [
                'name' => 'Wool Beanie',
                'category' => 'clothing',
                'description' => 'Warm knitted beanie for cold days.',
                'price' => 14.99,
                'stock' => 90,
                'image' => 'https://picsum.photos/seed/beanie/600/400',
            ],
            [
                'name' => 'Sunglasses',
                'category' => 'accessories',
                'description' => 'UV-protected polarized sunglasses with a classic frame.',
                'price' => 44.00,
                'stock' => 70,
                'image' => 'https://picsum.photos/seed/sunglasses/600/400',
            ],
        ];

        foreach ($products as $data) {
            $slug = Str::slug($data['name']);

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $categories[$data['category']] ?? null,
                    'name' => $data['name'],
                    'slug' => $slug,
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'stock' => $data['stock'],
                    'image' => $data['image'],
                    'is_active' => true,
                ]
            );
        }
    }
}
