@extends('layouts.customer')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">
    <!-- Section: Tentang Kami -->
    <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-2xl p-8 mb-10 border border-blue-100">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-700 mb-4 text-center">Tentang Kami</h1>
        <p class="text-lg text-gray-700 text-center mb-6">GalonProject adalah solusi modern untuk kebutuhan air rebus berkualitas, aman, dan praktis. Kami berkomitmen memberikan layanan terbaik untuk setiap pelanggan.</p>
        <div class="flex flex-col md:flex-row gap-8 justify-center items-center mb-6">
            <div class="flex-1">
                <h2 class="text-xl font-bold text-blue-600 mb-2">Visi</h2>
                <p class="text-gray-600">Menjadi penyedia air rebus terpercaya dan inovatif di Indonesia, mendukung gaya hidup sehat dan ramah lingkungan.</p>
            </div>
            <div class="flex-1">
                <h2 class="text-xl font-bold text-blue-600 mb-2">Misi</h2>
                <ul class="list-disc ml-6 text-gray-600">
                    <li>Menyediakan air rebus berkualitas tinggi dan aman konsumsi.</li>
                    <li>Mengutamakan pelayanan cepat, ramah, dan profesional.</li>
                    <li>Mengedukasi masyarakat tentang pentingnya air sehat.</li>
                </ul>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-blue-50 rounded-xl p-5 shadow flex flex-col items-center">
                <span class="text-3xl mb-2">💧</span>
                <h3 class="font-bold text-blue-700 mb-1">Kualitas Terjamin</h3>
                <p class="text-gray-600 text-center text-sm">Air rebus kami diproses dengan standar tinggi dan pengawasan ketat.</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-5 shadow flex flex-col items-center">
                <span class="text-3xl mb-2">⚡</span>
                <h3 class="font-bold text-blue-700 mb-1">Pelayanan Cepat</h3>
                <p class="text-gray-600 text-center text-sm">Pesanan diantar dengan cepat dan tepat waktu ke lokasi Anda.</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-5 shadow flex flex-col items-center">
                <span class="text-3xl mb-2">🌱</span>
                <h3 class="font-bold text-blue-700 mb-1">Ramah Lingkungan</h3>
                <p class="text-gray-600 text-center text-sm">Kami mendukung penggunaan galon ulang dan pengelolaan limbah yang baik.</p>
            </div>
        </div>
    </div>

    <!-- Section: Daftar Berita & Informasi -->
    <div class="mb-10">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center text-blue-700">Informasi & Berita Lengkap</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($news as $item)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition flex flex-col px-6 py-6">
                <a href="{{ route('customer.news.show', $item->id) }}" class="hover:underline">
                    <h3 class="text-base md:text-lg font-bold mb-2 text-blue-700 leading-snug line-clamp-2">{{ $item->title }}</h3>
                </a>
                <p class="text-sm text-gray-700 flex-1 mb-4">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                <p class="text-xs text-gray-400 mt-auto">{{ $item->published_at ? date('d M Y', strtotime($item->published_at)) : '' }}</p>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500">Belum ada berita/informasi.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
