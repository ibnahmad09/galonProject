@extends('layouts.customer')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white rounded-xl p-6 md:p-8 mb-8 shadow flex flex-col md:flex-row md:items-center md:justify-between">
    <div>
        <h1 class="text-2xl md:text-4xl font-extrabold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-base md:text-lg opacity-90">Pesan air rebus berkualitas dengan mudah</p>
    </div>
    <img src="https://img.icons8.com/fluency/96/water-bottle.png" alt="water" class="w-20 h-20 md:w-24 md:h-24 mt-4 md:mt-0 md:ml-8 mx-auto md:mx-0">
</div>

<!-- Promo Section -->
@if($promotions->count() > 0)
<div class="mb-8">
    <h2 class="text-lg md:text-xl font-bold mb-4 text-blue-700">Promo Hari Ini</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($promotions as $promo)
        <div class="bg-white p-4 md:p-5 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-base md:text-lg font-bold text-blue-700 mb-1">{{ $promo->product->name }}</h3>
            <p class="text-red-500 font-semibold">Diskon {{ $promo->discount_percent }}%</p>
            <p class="text-xs text-gray-400">Berlaku sampai {{ $promo->end_date->format('d M Y') }}</p>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Produk Terlaris -->
<div class="mb-8">
    <h2 class="text-lg md:text-xl font-bold mb-4 text-blue-700">Produk Kami</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @foreach($products as $product)
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition flex flex-col">
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-40 md:h-44 object-cover rounded-t-xl">
            <div class="p-3 md:p-4 flex-1 flex flex-col">
                <h3 class="font-bold text-base md:text-lg mb-1">{{ $product->name }}</h3>
                <p class="text-gray-500 mb-2 text-sm md:text-base">Rp {{ number_format($product->price) }}</p>
                <div class="mt-auto flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                    <button onclick="addToCart({{ $product->id }})" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700 transition text-sm md:text-base">Tambah ke Keranjang</button>
                    <a href="{{ route('customer.product.detail', $product->id) }}" class="text-blue-600 hover:underline ml-0 md:ml-2 text-sm md:text-base">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Informasi/Berita Section -->
<div class="mb-8">
    <h2 class="text-lg md:text-xl font-bold mb-4 text-blue-700">Informasi & Berita</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @forelse($news as $item)
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition flex flex-col">
            @if($item->image)
                <img src="{{ asset('storage/'.$item->image) }}" class="w-full h-28 md:h-32 object-cover rounded-t-xl mb-2" loading="lazy" alt="{{ $item->title }}">
            @endif
            <div class="p-3 md:p-4 flex-1 flex flex-col">
                <h3 class="text-base md:text-lg font-bold mb-1 line-clamp-2">{{ $item->title }}</h3>
                <p class="text-sm text-gray-500 flex-1 line-clamp-3">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                <p class="text-xs text-gray-400 mt-2">{{ $item->published_at ? date('d M Y', strtotime($item->published_at)) : '' }}</p>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-500">Belum ada berita/informasi.</div>
        @endforelse
    </div>
</div>

<!-- Referral Section -->
<div class="bg-white p-4 md:p-6 rounded-xl shadow mb-8">
    <h2 class="text-lg md:text-xl font-bold mb-2 text-blue-700">Kode Referral Anda</h2>
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 mb-2">
        <span class="font-mono text-base md:text-lg bg-gray-100 px-3 py-1 rounded">{{ Auth::user()->referral_code }}</span>
        <button onclick="navigator.clipboard.writeText('{{ Auth::user()->referral_code }}')" class="text-blue-600 hover:underline text-sm md:text-base">Salin</button>
    </div>
    <p class="text-sm text-gray-500 mb-2">Bagikan kode ini ke teman Anda. Jika mereka mendaftar dengan kode ini, Anda akan mendapatkan benefit khusus!</p>
    <div class="mt-4">
        <span class="font-semibold">Jumlah Referral Berhasil: </span>
        <span class="text-blue-700 font-bold">{{ $referralCount }}</span>
    </div>
    @if($referralCount > 0)
    <div class="mt-2">
        <span class="font-semibold">Daftar Referral:</span>
        <ul class="list-disc ml-6 text-sm mt-1">
            @foreach($referrals as $ref)
                <li>{{ $ref->name }} ({{ $ref->email }})</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<script>
function addToCart(productId) {
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
@endsection
