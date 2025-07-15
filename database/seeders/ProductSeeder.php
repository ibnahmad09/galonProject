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
                'name' => 'Air Rebus Isi Ulang',
                'price' => 6000,
                'category' => 'air',
                'description' => 'Air rebus isi ulang segar dan higienis.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Galon + Air Rebus',
                'price' => 51000,
                'category' => 'galon+air',
                'description' => 'Paket galon baru beserta air rebus isi ulang.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Galon Kosong',
                'price' => 45000,
                'category' => 'galon',
                'description' => 'Galon kosong berkualitas.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
