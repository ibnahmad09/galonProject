<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depot Air Minum Rebus</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
    @laravelPWA
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-30">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo dan Nama -->
            <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2 text-blue-700 text-2xl font-extrabold tracking-tight">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-droplets h-8 w-8 text-blue-600"><path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"></path><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"></path></svg>
                <span>Air Rebus Suci</span>
            </a>
            <!-- Menu Navigasi & Keranjang -->
            <div class="flex items-center gap-2 lg:gap-4">
                @auth
                <nav class="hidden md:flex items-center gap-2 lg:gap-4">
                    <a href="{{ route('customer.dashboard') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Beranda</a>
                    <a href="{{ route('customer.products') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Produk</a>
                    <a href="{{ route('customer.order.history') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Riwayat</a>
                    <a href="{{ route('customer.profile') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Profil</a>
                    <a href="{{ route('customer.about') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Tentang Kami</a>
                </nav>
                <!-- Tombol Keranjang -->
                <a href="{{ route('customer.cart') }}" class="ml-2 flex items-center gap-2 px-4 py-2 border border-gray-200 rounded bg-white shadow-sm hover:bg-blue-50 transition font-semibold relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Keranjang</span>
                    @php $cartCount = count(session('cart', [])) @endphp
                    @if($cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs border-2 border-white">{{ $cartCount }}</span>
                    @endif
                </a>
                @endauth
                @guest
                <nav class="hidden md:flex items-center gap-2 lg:gap-4">
                    <a href="{{ url('/') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Beranda</a>
                    <a href="{{ url('/') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Produk</a>
                    <a href="{{ route('about') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Tentang Kami</a>
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Login</a>
                </nav>
                @endguest
            </div>
            <!-- Mobile Hamburger tetap -->
            <div x-data="{ open: false }" class="md:hidden flex items-center relative">
                <button @click="open = !open" class="focus:outline-none" aria-label="Buka menu">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <!-- Overlay -->
                <div x-show="open" x-cloak @click="open = false" class="fixed inset-0 bg-black bg-opacity-40 z-30"></div>
                <!-- Mobile Menu -->
                <div x-show="open" x-transition x-cloak class="fixed top-0 left-0 w-full bg-white shadow-lg rounded-b-xl py-6 px-6 flex flex-col gap-2 z-40" style="max-width:100vw;">
                    @auth
                    <a href="{{ route('customer.dashboard') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Beranda</a>
                    <a href="{{ route('customer.products') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Produk</a>
                    <a href="{{ route('customer.order.history') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Riwayat</a>
                    <a href="{{ route('customer.profile') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Profil</a>
                    <a href="{{ route('customer.about') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Tentang Kami</a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="w-full mt-2 px-3 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Logout</button>
                    </form>
                    @endauth
                    @guest
                    <a href="{{ url('/') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Beranda</a>
                    <a href="{{ url('/') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Produk</a>
                    <a href="{{ route('about') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Tentang Kami</a>
                    <a href="{{ route('login') }}" @click="open = false" class="py-3 px-3 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Login</a>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-1 container-fluid mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer Baru -->
    <footer class="mt-8">
        <!-- Bagian Atas: Info & Kontak -->
        <div class="bg-blue-800 text-white py-10 px-4">
            <div class="container mx-auto flex flex-col md:flex-row justify-between gap-8">
                <!-- Kolom Kiri: Kontak -->
                <div class="md:w-1/2">
                    <h2 class="text-3xl font-bold mb-2">Hubungi Kami</h2>
                    <p class="mb-5 text-lg">Siap melayani kebutuhan air mineral berkualitas untuk keluarga Anda</p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.52l.3 1.2a2 2 0 01-.45 1.95l-.7.7a16 16 0 006.36 6.36l.7-.7a2 2 0 011.95-.45l1.2.3A2 2 0 0021 18.72V21a2 2 0 01-2 2h-1C7.82 23 1 16.18 1 8V7a2 2 0 012-2z"/></svg>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm0 0v1a4 4 0 01-8 0v-1"/></svg>
                            <span>info@airgalonsuci.com</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 12.414a2 2 0 00-2.828 0l-4.243 4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Jl. Sumber Air No. 123, Jakarta</span>
                        </li>
                    </ul>
                </div>
                <!-- Kolom Kanan: Jam Operasional & Area -->
                <div class="md:w-1/2 flex flex-col md:items-start md:justify-center">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-1">Jam Operasional</h3>
                        <p>Senin - Jumat: 08:00 - 18:00</p>
                        <p>Sabtu: 08:00 - 15:00</p>
                        <p>Minggu: Tutup</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-1">Area Pengiriman</h3>
                        <p>Jakarta, Bogor, Depok, Tangerang, Bekasi</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bagian Bawah: Logo & Copyright -->
        <div class="bg-black text-white py-6">
            <div class="container mx-auto flex flex-col items-center">
                <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-droplets h-6 w-6 text-blue-400"><path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"></path><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"></path></svg>
                    <span class="font-bold text-lg text-blue-100">Air Galon Suci</span>
                </div>
                <div class="text-sm text-blue-100">&copy; 2024 Air Galon Suci. Semua hak dilindungi.</div>
            </div>
        </div>
    </footer>
</body>
</html>
