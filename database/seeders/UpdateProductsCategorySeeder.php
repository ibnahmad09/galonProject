<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class UpdateProductsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $products = Product::all();

        foreach ($products as $product) {
            $product->category = 'air'; // Atur kategori default
            $product->save();
        }
    }
}
