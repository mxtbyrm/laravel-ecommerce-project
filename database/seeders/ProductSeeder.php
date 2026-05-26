<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Classic White T-Shirt',
                'description' => 'A soft, breathable 100% cotton tee that goes with everything.',
                'price' => 19.99,
                'stock' => 120,
                'image' => 'https://picsum.photos/seed/tshirt/600/400',
            ],
            [
                'name' => 'Denim Jacket',
                'description' => 'Timeless denim jacket with a relaxed fit and sturdy stitching.',
                'price' => 79.90,
                'stock' => 40,
                'image' => 'https://picsum.photos/seed/jacket/600/400',
            ],
            [
                'name' => 'Running Sneakers',
                'description' => 'Lightweight sneakers with cushioned soles for all-day comfort.',
                'price' => 99.00,
                'stock' => 60,
                'image' => 'https://picsum.photos/seed/sneakers/600/400',
            ],
            [
                'name' => 'Leather Wallet',
                'description' => 'Genuine leather bifold wallet with RFID protection.',
                'price' => 34.50,
                'stock' => 75,
                'image' => 'https://picsum.photos/seed/wallet/600/400',
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Over-ear headphones with active noise cancellation and 30h battery.',
                'price' => 149.99,
                'stock' => 25,
                'image' => 'https://picsum.photos/seed/headphones/600/400',
            ],
            [
                'name' => 'Stainless Water Bottle',
                'description' => 'Insulated 750ml bottle that keeps drinks cold for 24 hours.',
                'price' => 24.00,
                'stock' => 200,
                'image' => 'https://picsum.photos/seed/bottle/600/400',
            ],
            [
                'name' => 'Canvas Backpack',
                'description' => 'Durable everyday backpack with a padded laptop compartment.',
                'price' => 59.95,
                'stock' => 50,
                'image' => 'https://picsum.photos/seed/backpack/600/400',
            ],
            [
                'name' => 'Analog Wristwatch',
                'description' => 'Minimalist wristwatch with a stainless steel mesh band.',
                'price' => 129.00,
                'stock' => 30,
                'image' => 'https://picsum.photos/seed/watch/600/400',
            ],
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                array_merge($data, [
                    'slug' => Str::slug($data['name']),
                    'is_active' => true,
                ])
            );
        }
    }
}
