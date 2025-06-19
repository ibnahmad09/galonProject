<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel products.
     */
    public function run()
    {
        Product::insert([
            [
                'name' => 'Air Isi Ulang',
                'price' => 7000,
                'category' => 'air',
                'description' => 'Air isi ulang segar dan higienis.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Galon + Air',
                'price' => 25000,
                'category' => 'galon+air',
                'description' => 'Paket galon baru beserta air isi ulang.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Galon Kosong',
                'price' => 18000,
                'category' => 'galon',
                'description' => 'Galon kosong berkualitas.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
