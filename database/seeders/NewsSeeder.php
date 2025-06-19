<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel news.
     */
    public function run()
    {
        News::insert([
            [
                'title' => 'Manfaat Air Rebus untuk Kesehatan',
                'content' => 'Air rebus dapat membunuh bakteri dan kuman, sehingga lebih aman untuk dikonsumsi. Selain itu, air rebus juga membantu menjaga sistem pencernaan.',
                'image' => null,
                'published_at' => now()->subDays(3),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'title' => 'Tips Menyimpan Air Rebus yang Benar',
                'content' => 'Simpan air rebus dalam wadah bersih dan tertutup rapat. Hindari menyimpan air rebus di tempat terbuka agar tidak terkontaminasi.',
                'image' => null,
                'published_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'title' => 'Edukasi: Pentingnya Memilih Galon Berkualitas',
                'content' => 'Galon berkualitas terbuat dari bahan yang aman dan tidak mengandung BPA. Pilih galon yang sudah teruji dan bersertifikat.',
                'image' => null,
                'published_at' => now()->subDay(),
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
        ]);
    }
}
