<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Klaer Chill Suit',
            'category' => 'Трикотаж',
            'price' => 6500,
            'color' => 'Бежевый',
            'sizes' => 'S, M, L',
            'image' => 'images/item_suit.png'
        ]);

        Product::create([
            'name' => 'Klaer Urban',
            'category' => 'Обувь',
            'price' => 5900,
            'color' => 'Бежевый',
            'sizes' => 'S, M, L',
            'image' => 'images/item_shoes.png'
        ]);

        Product::create([
            'name' => 'Klaer Comfy Vest',
            'category' => 'Жилеты',
            'price' => 4200,
            'color' => 'Бежевый',
            'sizes' => 'S, M, L',
            'image' => 'images/item_vest.png'
        ]);
    }
}
