<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredient = new Product();
        $ingredient->name = 'MacBook Pro 13.3" Retina [MYD82] M1 Chip 256 GB - Space Gray';
        $ingredient->description = "";
        $ingredient->image = "apple.com/v/macbook-pro/ac/images/overview/hero_13__d1tfa5zby7e6_large_2x.jpg";
        $ingredient->brand = "Apple";
        $ingredient->price = 2000;
        $ingredient->price_sale = 1950;
        $ingredient->categories_id = 1;
        $ingredient->save();
    }
}
