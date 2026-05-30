<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Clothing', 'description' => 'Apparel and everyday wear.'],
            ['name' => 'Footwear', 'description' => 'Shoes and sneakers.'],
            ['name' => 'Accessories', 'description' => 'Wallets, watches and more.'],
            ['name' => 'Electronics', 'description' => 'Gadgets and audio gear.'],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                array_merge($data, ['slug' => Str::slug($data['name'])])
            );
        }
    }
}
