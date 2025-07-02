@extends('layouts.customer')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-b from-[#eaf3fb] to-white py-16 md:py-24">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-12">
        <div class="flex-1 max-w-xl">
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4 leading-tight">Air Mineral Berkualitas Tinggi</h1>
            <p class="text-lg md:text-xl text-blue-900/80 mb-8">Nikmati kesegaran air mineral Suci yang telah melalui proses penyaringan 7 tahap. Pengiriman cepat dan terpercaya langsung ke rumah Anda.</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="#produk" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded shadow text-center transition">Pesan Sekarang</a>
                <a href="#mengapa" class="bg-white border border-blue-700 text-blue-700 font-semibold px-6 py-3 rounded shadow text-center transition hover:bg-blue-50">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="flex-1 flex justify-center">
            <!-- Animasi Air Rebus -->
            <div class="relative w-[320px] h-[320px] md:w-[370px] md:h-[370px] flex items-center justify-center">
                <svg viewBox="0 0 200 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                    <!-- Gelas -->
                    <rect x="40" y="62" width="120" height="220" rx="30" fill="#fff" stroke="#60a5fa" stroke-width="4"/>
                    <!-- Air (wave) -->
                    <g>
                        <path id="wave" d="M40 180 Q 70 170 100 180 T 160 180 V260 Q160 280 140 280 H60 Q40 280 40 260 Z" fill="#38bdf8" fill-opacity="0.7">
                            <animate attributeName="d" dur="3s" repeatCount="indefinite"
                                values="M40 180 Q 70 170 100 180 T 160 180 V260 Q160 280 140 280 H60 Q40 280 40 260 Z;
                                        M40 185 Q 70 190 100 185 T 160 185 V260 Q160 280 140 280 H60 Q40 280 40 260 Z;
                                        M40 180 Q 70 170 100 180 T 160 180 V260 Q160 280 140 280 H60 Q40 280 40 260 Z"/>
                        </path>
                    </g>
                    <!-- Bubble -->
                    <circle class="bubble" cx="80" cy="230" r="7" fill="#bae6fd"/>
                    <circle class="bubble" cx="120" cy="250" r="5" fill="#bae6fd"/>
                    <circle class="bubble" cx="100" cy="210" r="4" fill="#bae6fd"/>
                </svg>
                <style>
                @keyframes bubbleUp1 {
                    0% { transform: translateY(0) scale(1); opacity: 0.7; }
                    60% { opacity: 1; }
                    100% { transform: translateY(-70px) scale(1.2); opacity: 0; }
                }
                @keyframes bubbleUp2 {
                    0% { transform: translateY(0) scale(1); opacity: 0.7; }
                    60% { opacity: 1; }
                    100% { transform: translateY(-90px) scale(1.1); opacity: 0; }
                }
                @keyframes bubbleUp3 {
                    0% { transform: translateY(0) scale(1); opacity: 0.7; }
                    60% { opacity: 1; }
                    100% { transform: translateY(-60px) scale(1.3); opacity: 0; }
                }
                .bubble:nth-of-type(2) { animation: bubbleUp1 2.5s infinite ease-in-out; }
                .bubble:nth-of-type(3) { animation: bubbleUp2 3.2s infinite 0.8s ease-in-out; }
                .bubble:nth-of-type(4) { animation: bubbleUp3 2.8s infinite 1.2s ease-in-out; }
                </style>
            </div>
        </div>
    </div>
</div>

<!-- Mengapa Memilih Section -->
<div id="mengapa" class="bg-white py-16">
    <div class="container mx-auto">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-blue-800 mb-12">Mengapa Memilih Air Galon Suci?</h2>
        <div class="flex flex-col md:flex-row justify-center items-stretch gap-12">
            <div class="flex-1 flex flex-col items-center text-center">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-blue-600 mx-auto" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 2C12 2 4 12.5 4 18C4 21.3137 7.13401 24 12 24C16.866 24 20 21.3137 20 18C20 12.5 12 2 12 2Z" stroke="#2563eb" stroke-width="2.5" fill="#fff"/><circle cx="12" cy="18" r="3" fill="#fff" stroke="#2563eb" stroke-width="2.5"/></svg>
                </div>
                <h3 class="font-bold text-lg text-blue-900 mb-1">Kualitas Terjamin</h3>
                <p class="text-gray-600 text-sm">Proses penyaringan 7 tahap dengan teknologi modern</p>
            </div>
            <div class="flex-1 flex flex-col items-center text-center">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-blue-600 mx-auto" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="10" rx="5" stroke="#2563eb" stroke-width="2.5" fill="#fff"/><path d="M7 12h10" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round"/></svg>
                </div>
                <h3 class="font-bold text-lg text-blue-900 mb-1">Pengiriman Cepat</h3>
                <p class="text-gray-600 text-sm">Layanan antar langsung ke rumah dalam 24 jam</p>
            </div>
            <div class="flex-1 flex flex-col items-center text-center">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-blue-600 mx-auto" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" stroke="#2563eb" stroke-width="2.5" fill="#fff"/></svg>
                </div>
                <h3 class="font-bold text-lg text-blue-900 mb-1">Harga Terjangkau</h3>
                <p class="text-gray-600 text-sm">Kualitas premium dengan harga yang bersahabat</p>
            </div>
        </div>
    </div>
</div>

<!-- Produk Kami Section -->
<div id="produk" class="py-16 bg-gradient-to-b from-white to-[#eaf3fb]">
    <div class="container mx-auto">
        <h2 class="text-2xl md:text-3xl font-bold mb-12 text-center text-blue-900">Produk Kami</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $i => $product)
            <div class="relative bg-white rounded-2xl shadow-md hover:shadow-xl transition flex flex-col border @if($i === 0) border-2 border-blue-200 ring-2 ring-blue-300 scale-105 z-10 @else border-gray-200 @endif">
                @if($i === 0)
                <div class="absolute -top-7 left-6 flex items-center gap-2 bg-white px-5 py-2 rounded-full shadow border border-blue-100 text-blue-700 font-bold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"/><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"/></svg>
                    Air Galon Suci
                </div>
                @endif
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-44 md:h-52 object-cover rounded-t-2xl mt-10 @if($i === 0) border-b-2 border-blue-100 @endif">
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        @if($i === 0)
                        <span class="text-xs bg-blue-100 text-blue-700 font-bold px-2 py-1 rounded">Best Seller</span>
                        @endif
                        <span class="ml-auto flex items-center gap-1 text-yellow-500 text-sm font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.175c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.38-2.455a1 1 0 00-1.175 0l-3.38 2.455c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.175a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                            {{ number_format($product->rating, 1) }}
                        </span>
                    </div>
                    <h3 class="font-bold text-lg text-blue-900 mb-1">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $product->description }}</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-blue-700 font-bold text-lg">Rp {{ number_format($product->price) }}</span>
                        <span class="text-xs text-gray-500">Stok: {{ $product->stock }}</span>
                    </div>
                    <button onclick="addToCart({{ $product->id }})" class="bg-blue-900 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-800 transition w-full">Tambah ke Keranjang</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Informasi & Berita Section -->
@if(isset($news) && $news->count() > 0)
<div class="mb-16 container mx-auto">
    <h2 class="text-2xl md:text-3xl font-bold mb-10 text-center text-blue-800">Informasi & Berita</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($news->take(3) as $item)
        <div class="relative bg-white border border-blue-100 rounded-2xl shadow-sm hover:shadow-xl hover:scale-[1.03] transition-all flex flex-col px-7 py-7 mx-auto min-h-[260px]">
            <span class="absolute top-5 right-5 bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full border border-blue-100 shadow-sm">{{ $item->published_at ? date('d M Y', strtotime($item->published_at)) : '' }}</span>
            <h3 class="text-lg md:text-xl font-extrabold mb-3 text-blue-700 leading-snug line-clamp-2">{{ $item->title }}</h3>
            <p class="text-sm text-gray-700 flex-1 mb-4 line-clamp-4">{{ Str::limit(strip_tags($item->content), 140) }}</p>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="mb-16 container mx-auto">
    <h2 class="text-2xl md:text-3xl font-bold mb-10 text-center text-blue-800">Informasi & Berita</h2>
    <div class="text-center text-gray-500">Belum ada berita/informasi.</div>
</div>
@endif

<script>
function addToCart(productId) {
    fetch('{{ route("cart.add", "") }}/' + productId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (response.headers.get('content-type')?.includes('application/json')) {
            return response.json();
        } else {
            throw new Error('Bukan response JSON');
        }
    })
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Gagal menambah ke keranjang. Silakan coba lagi.');
    });
}
</script>
@endsection