<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depot Air Minum Rebus</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-30">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2 text-blue-700 text-2xl font-extrabold tracking-tight">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2C7.03 2 2.5 6.03 2.5 11c0 4.97 4.53 9 9.5 9s9.5-4.03 9.5-9c0-4.97-4.53-9-9.5-9zm0 16c-3.87 0-7-3.13-7-7 0-3.87 3.13-7 7-7s7 3.13 7 7c0 3.87-3.13 7-7 7z"/></svg>
                Depot Air Minum
            </a>
            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-2 lg:gap-4">
                <a href="{{ route('customer.products') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Produk</a>
                <a href="{{ route('customer.order.history') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Riwayat</a>
                <a href="{{ route('customer.profile') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Profil</a>
                <a href="{{ route('customer.about') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Tentang Kami</a>
                <a href="{{ route('customer.cart') }}" class="relative px-3 py-2 rounded hover:bg-blue-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @php $cartCount = count(session('cart', [])) @endphp
                    @if($cartCount > 0)

                    <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs border-2 border-white">{{ $cartCount }}</span>
                    @endif
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="ml-2 px-3 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Logout</button>
                </form>
            </nav>
            <!-- Mobile Hamburger -->
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
                    <a href="{{ route('customer.products', ['category' => 'semua']) }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Produk</a>
                    <a href="{{ route('customer.order.history') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Riwayat</a>
                    <a href="{{ route('customer.profile') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Profil</a>
                    <a href="{{ route('customer.about') }}" @click="open = false" class="py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Tentang Kami</a>
                    <a href="{{ route('customer.cart') }}" @click="open = false" class="relative py-3 px-3 rounded hover:bg-blue-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-700 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs border-2 border-white">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="w-full mt-2 px-3 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-1 container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t text-gray-500 text-sm text-center py-4 mt-8">
        &copy; 2024 Depot Air Minum Rebus. All rights reserved.
    </footer>
</body>
</html>
