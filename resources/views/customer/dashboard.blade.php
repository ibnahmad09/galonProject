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

<!-- Login/Register Section untuk Guest -->
@guest
<div class="bg-gradient-to-br from-blue-50 via-white to-blue-100 py-20 relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-10 left-10 w-32 h-32 bg-blue-200 rounded-full opacity-20 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full opacity-30 animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-blue-100 rounded-full opacity-40 animate-spin"></div>
    </div>

    <div class="container mx-auto relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-black text-blue-900 mb-4">Bergabunglah dengan Kami</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Dapatkan akses penuh untuk memesan air mineral berkualitas tinggi dengan pengiriman cepat dan layanan terbaik</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <!-- Login Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-blue-100 hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-blue-900 mb-2">Sudah Punya Akun?</h3>
                    <p class="text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <div class="space-y-4 mb-6">
                    <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-blue-800">Akses ke keranjang belanja</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-blue-800">Riwayat pesanan lengkap</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-blue-800">Notifikasi pengiriman real-time</span>
                    </div>
                </div>

                <a href="{{ route('login') }}" class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-4 px-6 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 text-center shadow-lg hover:shadow-xl transform hover:scale-105">
                    <span class="flex items-center justify-center gap-2">
                        Masuk Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </span>
                </a>
            </div>

            <!-- Register Card -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl shadow-2xl p-8 text-white hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Baru di Sini?</h3>
                    <p class="text-blue-100">Daftar sekarang dan dapatkan keuntungan khusus</p>
                </div>

                <div class="space-y-4 mb-6">
                    <div class="flex items-center gap-3 p-3 bg-white/10 backdrop-blur-sm rounded-lg">
                        <svg class="w-5 h-5 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                        <span class="text-sm">Diskon 10% untuk pendaftar baru</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/10 backdrop-blur-sm rounded-lg">
                        <svg class="w-5 h-5 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span class="text-sm">Gratis ongkir pertama</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-white/10 backdrop-blur-sm rounded-lg">
                        <svg class="w-5 h-5 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">Pengiriman prioritas 24 jam</span>
                    </div>
                </div>

                <a href="{{ route('register') }}" class="block w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-900 font-bold py-4 px-6 rounded-xl hover:from-yellow-500 hover:to-yellow-600 transition-all duration-300 text-center shadow-lg hover:shadow-xl transform hover:scale-105">
                    <span class="flex items-center justify-center gap-2">
                        Daftar Gratis
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center mt-12">
            <p class="text-gray-600 mb-4">Dengan mendaftar, Anda menyetujui <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a> kami</p>
            <div class="flex items-center justify-center gap-6 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>100% Aman</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Gratis Daftar</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>24/7 Support</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest

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

                    </div>
                    <h3 class="font-bold text-lg text-blue-900 mb-1">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $product->description }}</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-blue-700 font-bold text-lg">Rp {{ number_format($product->price) }}</span>
                    </div>
                    @guest
                    <button onclick="showLoginPopup()" class="bg-gradient-to-r from-blue-700 to-blue-900 text-white font-semibold px-6 py-3 rounded-lg hover:from-blue-800 hover:to-blue-900 transition w-full shadow-lg">Tambah ke Keranjang</button>
                    @else
                    <button onclick="addToCart({{ $product->id }})" class="bg-gradient-to-r from-blue-700 to-blue-900 text-white font-semibold px-6 py-3 rounded-lg hover:from-blue-800 hover:to-blue-900 transition w-full shadow-lg">Tambah ke Keranjang</button>
                    @endguest
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

<!-- Popup Login untuk Guest -->
<div id="loginPopup" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full text-center relative">
        <button onclick="closeLoginPopup()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</button>
        <svg class="mx-auto mb-4 w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        <h3 class="text-xl font-bold mb-2 text-blue-800">Login Diperlukan</h3>
        <p class="text-gray-600 mb-6">Anda harus login terlebih dahulu untuk menambah produk ke keranjang.</p>
        <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">Login Sekarang</a>
    </div>
</div>

<script>
function showLoginPopup() {
    document.getElementById('loginPopup').classList.remove('hidden');
}
function closeLoginPopup() {
    document.getElementById('loginPopup').classList.add('hidden');
}
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
