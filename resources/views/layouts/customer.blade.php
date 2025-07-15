<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depot Air Minum Rebus</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Animasi Air dan Uap */
        .water-header {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 50%, #7dd3fc 100%);
        }

        .water-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 1;
        }

        .wave {
            position: absolute;
            bottom: 0;
            width: 200%;
            height: 15px;
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.4) 50%, transparent 100%);
            animation: waveMove 6s infinite linear;
        }

        .wave:nth-child(2) {
            animation-delay: -3s;
            opacity: 0.6;
        }

        .wave:nth-child(3) {
            animation-delay: -1.5s;
            opacity: 0.3;
        }

        .steam-particle {
            position: absolute;
            background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.2) 100%);
            border-radius: 50%;
            animation: steamRise 4s infinite ease-out;
        }

        .bubble {
            position: absolute;
            background: radial-gradient(circle, rgba(255,255,255,0.6) 0%, rgba(255,255,255,0.1) 100%);
            border-radius: 50%;
            animation: bubbleFloat 8s infinite ease-in-out;
        }

        @keyframes waveMove {
            0% {
                transform: translateX(-50%);
            }
            100% {
                transform: translateX(50%);
            }
        }

        @keyframes steamRise {
            0% {
                transform: translateY(0) scale(0.1);
                opacity: 0;
            }
            20% {
                opacity: 0.8;
            }
            80% {
                opacity: 0.4;
            }
            100% {
                transform: translateY(-150px) scale(1.5);
                opacity: 0;
            }
        }

        @keyframes bubbleFloat {
            0% {
                transform: translateY(100vh) scale(0.2);
                opacity: 0;
            }
            20% {
                opacity: 0.6;
            }
            80% {
                opacity: 0.4;
            }
            100% {
                transform: translateY(-100px) scale(1.2);
                opacity: 0;
            }
        }

        .logo-container {
            position: relative;
            z-index: 10;
        }

        .logo-container::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 12px;
            background: linear-gradient(to bottom, #3b82f6, transparent);
            border-radius: 1px;
            animation: waterDrop 2s infinite ease-in-out;
        }

        @keyframes waterDrop {
            0%, 100% {
                opacity: 0.6;
                transform: translateX(-50%) scaleY(1);
            }
            50% {
                opacity: 1;
                transform: translateX(-50%) scaleY(1.2);
            }
        }

        /* Mobile Menu Styles */
        #mobile-menu {
            transform: translateY(-100%);
            transition: transform 0.3s ease-in-out;
        }

        #mobile-menu.show {
            transform: translateY(0);
        }

        .mobile-menu-item {
            position: relative;
            overflow: hidden;
        }

        .mobile-menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.5s;
        }

        .mobile-menu-item:hover::before {
            left: 100%;
        }

        #hamburger-btn {
            position: relative;
            transition: transform 0.2s ease;
        }

        #hamburger-btn:hover {
            transform: scale(1.1);
        }

        #hamburger-btn:active {
            transform: scale(0.95);
        }
    </style>
    @laravelPWA
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header dengan Animasi Air -->
    <header class="water-header shadow-sm sticky top-0 z-30">
        <div class="water-overlay">
            <!-- Ombak -->
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
        <div class="container mx-auto px-4 py-3 flex justify-between items-center relative z-10">
            <!-- Logo dan Nama dengan Animasi -->
            <a href="{{ route('customer.dashboard') }}" class="logo-container flex items-center gap-2 text-blue-700 text-2xl font-extrabold tracking-tight">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-blue-600">
                        <path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"></path>
                        <path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"></path>
                    </svg>
                </div>
                <span class="relative">
                    Air Rebus Suci
                </span>
            </a>
            <!-- Menu Navigasi & Keranjang -->
            <div class="flex items-center gap-2 lg:gap-4">
                @auth
                <nav class="hidden md:flex items-center gap-2 lg:gap-4">
                    <a href="{{ route('customer.dashboard') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Beranda</a>
                    <a href="{{ route('customer.products') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Produk</a>
                    <a href="{{ route('customer.order.history') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Riwayat</a>
                    <a href="{{ route('customer.referral.index') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Referral</a>
                    <a href="{{ route('customer.about') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Tentang Kami</a>
                    <a href="{{ route('customer.profile') }}" class="px-3 py-2 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded hover:bg-red-50 transition text-red-600 font-medium">
                            Logout
                        </button>
                    </form>
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
            <!-- Mobile Hamburger -->
            <div class="md:hidden flex items-center relative">
                <button id="hamburger-btn" class="focus:outline-none" aria-label="Buka menu">
                    <svg id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <!-- Overlay -->
                <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-40 z-30 hidden"></div>
                <!-- Mobile Menu -->
                <div id="mobile-menu" class="fixed top-0 left-0 w-full bg-white shadow-lg rounded-b-xl py-6 px-6 flex flex-col gap-2 z-40 hidden" style="max-width:100vw;">
                    @auth
                    <a href="{{ route('customer.dashboard') }}" class="mobile-menu-item py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Beranda</a>
                    <a href="{{ route('customer.products') }}" class="mobile-menu-item py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Produk</a>
                    <a href="{{ route('customer.order.history') }}" class="mobile-menu-item py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Riwayat</a>
                    <a href="{{ route('customer.referral.index') }}" class="mobile-menu-item py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Referral</a>
                    <a href="{{ route('customer.about') }}" class="mobile-menu-item py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Tentang Kami</a>
                    <a href="{{ route('customer.profile') }}" class="mobile-menu-item py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Profil</a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="w-full mt-2 px-3 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Logout</button>
                    </form>
                    @endauth
                    @guest
                    <a href="{{ url('/') }}" class="mobile-menu-item py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Beranda</a>
                    <a href="{{ url('/') }}" class="mobile-menu-item py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Produk</a>
                    <a href="{{ route('about') }}" class="mobile-menu-item py-3 px-3 rounded hover:bg-blue-50 transition text-gray-700 font-medium">Tentang Kami</a>
                    <a href="{{ route('login') }}" class="mobile-menu-item py-3 px-3 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Login</a>
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
                    <p class="mb-5 text-lg">Siap melayani kebutuhan air rebus untuk keluarga Anda</p>
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
                            <span>Rokan IV Koto, Rokan Hulu, Riau</span>
                        </li>
                    </ul>
                </div>
                <!-- Kolom Kanan: Jam Operasional & Area -->
                <div class="md:w-1/2 flex flex-col md:items-start md:justify-center">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-1">Jam Operasional</h3>
                        <p>Sabtu - Kamis: 08:00 - 18:00</p>
                        <p>Jumat: Offline</p>
                    <div>
                        <h3 class="text-xl font-semibold mb-1">Area Pengiriman</h3>
                        <p>Desa Rokan Koto Ruang</p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- Bagian Bawah: Logo & Copyright -->
    <div class="bg-black text-white py-6">
        <div class="container mx-auto flex flex-col items-center">
            <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-droplets h-6 w-6 text-blue-400"><path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"></path><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"></path></svg>
                <span class="font-bold text-lg text-blue-100">Air Rebus Suci</span>
            </div>
            <div class="text-sm text-blue-100">&copy; 2025 Air Rebus Suci. Semua hak dilindungi.</div>
        </div>
    </div>

    <!-- JavaScript untuk Animasi Air dan Mobile Menu -->
    <script>
        // Animasi Air dan Uap
        class WaterAnimation {
            constructor() {
                this.container = document.querySelector('.water-overlay');
                this.isRunning = false;
                this.init();
            }

            init() {
                this.createSteamParticles();
                this.createBubbles();
                this.startAnimation();
            }

            createSteamParticles() {
                for (let i = 0; i < 8; i++) {
                    setTimeout(() => {
                        this.createSteamParticle();
                    }, i * 500);
                }
            }

            createSteamParticle() {
                const steam = document.createElement('div');
                steam.className = 'steam-particle';
                steam.style.left = Math.random() * 100 + '%';
                steam.style.bottom = Math.random() * 30 + '%';
                steam.style.width = (Math.random() * 4 + 2) + 'px';
                steam.style.height = (Math.random() * 4 + 2) + 'px';
                steam.style.animationDelay = Math.random() * 2 + 's';
                steam.style.animationDuration = (Math.random() * 2 + 3) + 's';

                this.container.appendChild(steam);

                setTimeout(() => {
                    if (steam.parentNode) {
                        steam.parentNode.removeChild(steam);
                    }
                }, 5000);
            }

            createBubbles() {
                for (let i = 0; i < 6; i++) {
                    setTimeout(() => {
                        this.createBubble();
                    }, i * 800);
                }
            }

            createBubble() {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                bubble.style.left = Math.random() * 100 + '%';
                bubble.style.width = (Math.random() * 8 + 4) + 'px';
                bubble.style.height = (Math.random() * 8 + 4) + 'px';
                bubble.style.animationDelay = Math.random() * 3 + 's';
                bubble.style.animationDuration = (Math.random() * 3 + 5) + 's';

                this.container.appendChild(bubble);

                setTimeout(() => {
                    if (bubble.parentNode) {
                        bubble.parentNode.removeChild(bubble);
                    }
                }, 8000);
            }

            startAnimation() {
                this.isRunning = true;

                // Buat steam particles secara berkelanjutan
                setInterval(() => {
                    if (this.isRunning) {
                        this.createSteamParticle();
                    }
                }, 2000);

                // Buat bubbles secara berkelanjutan
                setInterval(() => {
                    if (this.isRunning) {
                        this.createBubble();
                    }
                }, 3000);
            }

            stopAnimation() {
                this.isRunning = false;
            }
        }

        // Mobile Menu JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi animasi air
            const waterAnimation = new WaterAnimation();

            const hamburgerBtn = document.getElementById('hamburger-btn');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileOverlay = document.getElementById('mobile-overlay');

            let isMenuOpen = false;

            function toggleMenu() {
                isMenuOpen = !isMenuOpen;

                if (isMenuOpen) {
                    // Buka menu
                    hamburgerIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    mobileMenu.classList.remove('hidden');
                    mobileOverlay.classList.remove('hidden');

                    // Animasi slide down menggunakan class
                    setTimeout(() => {
                        mobileMenu.classList.add('show');
                    }, 10);

                    // Prevent scroll pada body
                    document.body.style.overflow = 'hidden';
                } else {
                    // Tutup menu
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');

                    // Animasi slide up
                    mobileMenu.classList.remove('show');

                    // Enable scroll pada body
                    document.body.style.overflow = 'auto';

                    // Tutup overlay setelah animasi selesai
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileOverlay.classList.add('hidden');
                    }, 300);
                }
            }

            // Event listeners
            hamburgerBtn.addEventListener('click', toggleMenu);
            mobileOverlay.addEventListener('click', toggleMenu);

            // Tutup menu saat klik pada menu item
            const mobileMenuItems = document.querySelectorAll('.mobile-menu-item');
            mobileMenuItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (isMenuOpen) {
                        toggleMenu();
                    }
                });
            });
        });
    </script>
</body>
</html>
