@extends('layouts.customer')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-b from-[#eaf3fb] to-white py-16 md:py-24 relative overflow-hidden">
    <!-- Animated Water Waves -->
    <div id="waterWaves" class="absolute inset-0 pointer-events-none">
        <canvas id="waveCanvas" class="w-full h-full"></canvas>
    </div>

    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-12 relative z-10">
        <div class="flex-1 max-w-xl">
            <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4 leading-tight">Air Mineral</h1>
            <p class="text-lg md:text-xl text-blue-900/80 mb-8">Dari Dapur, bukan dari pabrik iklan karena air segar tidak harus mahal.</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="#produk" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded shadow text-center transition">Pesan Sekarang</a>
                <a href="#mengapa" class="bg-white border border-blue-700 text-blue-700 font-semibold px-6 py-3 rounded shadow text-center transition hover:bg-blue-50">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="flex-1 flex justify-center">
            <!-- Animasi Dandang dengan Api Kompor -->
            <div class="relative w-[320px] h-[320px] md:w-[370px] md:h-[370px] flex items-center justify-center">
                <svg viewBox="0 0 200 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                    <!-- Panci Raksasa -->
                    <g class="pot-group">
                        <!-- Badan Panci -->
                        <rect x="20" y="115" width="160" height="130" rx="20" ry="20" fill="#f3f4f6" stroke="#6b7280" stroke-width="3"/>
                        <!-- Tutup Panci -->
                        <rect x="25" y="110" width="150" height="20" rx="15" ry="15" fill="#e5e7eb" stroke="#6b7280" stroke-width="2"/>
                        <!-- Pegangan Tutup -->
                        <rect x="90" y="105" width="20" height="10" rx="3" fill="#9ca3af"/>
                        <!-- Mulut Panci -->
                        <rect x="30" y="110" width="140" height="15" rx="10" ry="10" fill="#d1d5db" stroke="#6b7280" stroke-width="2"/>
                        <!-- Kaki Panci -->
                        <rect x="85" y="245" width="30" height="15" rx="5" fill="#6b7280"/>
                        <rect x="75" y="260" width="50" height="8" rx="4" fill="#4b5563"/>
                    </g>

                    <!-- Air Mendidih di dalam Panci Raksasa -->
                    <g>
                        <rect x="25" y="125" width="150" height="110" rx="15" ry="15" fill="#38bdf8" fill-opacity="0.8">
                            <animate attributeName="height" dur="2s" repeatCount="indefinite"
                                values="110;115;112;110"/>
                        </rect>
                        <!-- Gelombang air di permukaan -->
                        <path id="waterSurface" d="M25 125 Q 50 120 100 125 T 175 125" stroke="#38bdf8" stroke-width="6" fill="none" opacity="0.6">
                            <animate attributeName="d" dur="1.5s" repeatCount="indefinite"
                                values="M25 125 Q 50 120 100 125 T 175 125;
                                        M25 128 Q 50 123 100 128 T 175 128;
                                        M25 126 Q 50 121 100 126 T 175 126;
                                        M25 125 Q 50 120 100 125 T 175 125"/>
                        </path>
                    </g>

                    <!-- Gelembung Air Mendidih -->
                    <circle class="boiling-bubble" cx="40" cy="190" r="4" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="60" cy="175" r="5" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="80" cy="195" r="3" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="50" cy="185" r="4" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="70" cy="170" r="3" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="45" cy="180" r="3" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="65" cy="190" r="4" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="55" cy="175" r="3" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="75" cy="185" r="3" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="90" cy="180" r="3" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="100" cy="190" r="3" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="110" cy="175" r="4" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="120" cy="185" r="3" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="130" cy="180" r="4" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="140" cy="190" r="3" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="150" cy="175" r="4" fill="#bae6fd"/>
                    <circle class="boiling-bubble" cx="160" cy="185" r="3" fill="#bae6fd"/>

                                                            <!-- Uap Air Mendidih -->
                    <g class="steam-group">
                        <!-- Uap 1 -->
                        <path class="steam" d="M40 110 Q 60 100 100 110 Q 140 120 160 110" stroke="#e2e8f0" stroke-width="4" fill="none" opacity="0.6">
                            <animate attributeName="d" dur="3s" repeatCount="indefinite"
                                values="M40 110 Q 60 100 100 110 Q 140 120 160 110;
                                        M40 105 Q 60 95 100 105 Q 140 115 160 105;
                                        M40 100 Q 60 90 100 100 Q 140 110 160 100;
                                        M40 110 Q 60 100 100 110 Q 140 120 160 110"/>
                            <animate attributeName="opacity" dur="3s" repeatCount="indefinite"
                                values="0.6;0.3;0.8;0.6"/>
                        </path>

                        <!-- Uap 2 -->
                        <path class="steam" d="M50 115 Q 70 105 100 115 Q 130 125 150 115" stroke="#e2e8f0" stroke-width="4" fill="none" opacity="0.5">
                            <animate attributeName="d" dur="2.5s" repeatCount="indefinite"
                                values="M50 115 Q 70 105 100 115 Q 130 125 150 115;
                                        M50 110 Q 70 100 100 110 Q 130 120 150 110;
                                        M50 105 Q 70 95 100 105 Q 130 115 150 105;
                                        M50 115 Q 70 105 100 115 Q 130 125 150 115"/>
                            <animate attributeName="opacity" dur="2.5s" repeatCount="indefinite"
                                values="0.5;0.2;0.7;0.5"/>
                        </path>

                        <!-- Uap 3 -->
                        <path class="steam" d="M60 120 Q 80 110 100 120 Q 120 130 140 120" stroke="#e2e8f0" stroke-width="4" fill="none" opacity="0.4">
                            <animate attributeName="d" dur="3.5s" repeatCount="indefinite"
                                values="M60 120 Q 80 110 100 120 Q 120 130 140 120;
                                        M60 115 Q 80 105 100 115 Q 120 125 140 115;
                                        M60 110 Q 80 100 100 110 Q 120 120 140 110;
                                        M60 120 Q 80 110 100 120 Q 120 130 140 120"/>
                            <animate attributeName="opacity" dur="3.5s" repeatCount="indefinite"
                                values="0.4;0.1;0.6;0.4"/>
                        </path>
                    </g>

                    <!-- Kompor Gas Raksasa -->
                    <g class="stove-group">
                        <!-- Badan Kompor -->
                        <rect x="50" y="245" width="100" height="25" rx="8" fill="#374151" stroke="#1f2937" stroke-width="2"/>
                        <!-- Panel Kontrol -->
                        <rect x="60" y="250" width="80" height="15" rx="3" fill="#6b7280"/>
                        <!-- Tombol Kontrol -->
                        <circle cx="75" cy="257" r="3" fill="#ef4444"/>
                        <circle cx="90" cy="257" r="3" fill="#f59e0b"/>
                        <circle cx="105" cy="257" r="3" fill="#10b981"/>
                        <circle cx="120" cy="257" r="3" fill="#3b82f6"/>
                        <circle cx="135" cy="257" r="3" fill="#8b5cf6"/>
                    </g>

                                        <!-- Api Kompor Raksasa -->
                    <g class="fire-group">
                        <!-- Api Utama -->
                        <path class="fire-main" d="M60 245 Q 70 225 80 245 Q 90 265 100 245 Q 110 225 120 245 Q 130 265 140 245" stroke="#ef4444" stroke-width="4" fill="none" opacity="0.8">
                            <animate attributeName="d" dur="0.8s" repeatCount="indefinite"
                                values="M60 245 Q 70 225 80 245 Q 90 265 100 245 Q 110 225 120 245 Q 130 265 140 245;
                                        M60 245 Q 70 230 80 245 Q 90 260 100 245 Q 110 230 120 245 Q 130 260 140 245;
                                        M60 245 Q 70 225 80 245 Q 90 265 100 245 Q 110 225 120 245 Q 130 265 140 245"/>
                            <animate attributeName="opacity" dur="0.8s" repeatCount="indefinite"
                                values="0.8;0.6;0.8"/>
                        </path>

                        <!-- Api Sekunder -->
                        <path class="fire-secondary" d="M65 245 Q 70 235 75 245 Q 80 255 85 245 Q 90 235 95 245 Q 100 255 105 245 Q 110 235 115 245 Q 120 255 125 245 Q 130 235 135 245" stroke="#f97316" stroke-width="3" fill="none" opacity="0.6">
                            <animate attributeName="d" dur="1.2s" repeatCount="indefinite"
                                values="M65 245 Q 70 235 75 245 Q 80 255 85 245 Q 90 235 95 245 Q 100 255 105 245 Q 110 235 115 245 Q 120 255 125 245 Q 130 235 135 245;
                                        M65 245 Q 70 240 75 245 Q 80 250 85 245 Q 90 240 95 245 Q 100 250 105 245 Q 110 240 115 245 Q 120 250 125 245 Q 130 240 135 245;
                                        M65 245 Q 70 235 75 245 Q 80 255 85 245 Q 90 235 95 245 Q 100 255 105 245 Q 110 235 115 245 Q 120 255 125 245 Q 130 235 135 245"/>
                            <animate attributeName="opacity" dur="1.2s" repeatCount="indefinite"
                                values="0.6;0.4;0.6"/>
                        </path>

                        <!-- Bara Api -->
                        <circle class="ember" cx="70" cy="240" r="2" fill="#fbbf24" opacity="0.8">
                            <animate attributeName="opacity" dur="1s" repeatCount="indefinite" values="0.8;0.3;0.8"/>
                        </circle>
                        <circle class="ember" cx="80" cy="243" r="2" fill="#f59e0b" opacity="0.7">
                            <animate attributeName="opacity" dur="1.3s" repeatCount="indefinite" values="0.7;0.2;0.7"/>
                        </circle>
                        <circle class="ember" cx="90" cy="241" r="2" fill="#fbbf24" opacity="0.9">
                            <animate attributeName="opacity" dur="0.9s" repeatCount="indefinite" values="0.9;0.4;0.9"/>
                        </circle>
                        <circle class="ember" cx="100" cy="242" r="2" fill="#f59e0b" opacity="0.6">
                            <animate attributeName="opacity" dur="1.1s" repeatCount="indefinite" values="0.6;0.1;0.6"/>
                        </circle>
                        <circle class="ember" cx="110" cy="240" r="2" fill="#fbbf24" opacity="0.8">
                            <animate attributeName="opacity" dur="0.7s" repeatCount="indefinite" values="0.8;0.3;0.8"/>
                        </circle>
                        <circle class="ember" cx="120" cy="243" r="2" fill="#f59e0b" opacity="0.7">
                            <animate attributeName="opacity" dur="1.4s" repeatCount="indefinite" values="0.7;0.2;0.7"/>
                        </circle>
                        <circle class="ember" cx="130" cy="241" r="2" fill="#fbbf24" opacity="0.8">
                            <animate attributeName="opacity" dur="0.8s" repeatCount="indefinite" values="0.8;0.3;0.8"/>
                        </circle>
                    </g>

                    <!-- Efek Panas di Sekitar Kompor -->
                    <g class="heat-effect">
                        <line x1="75" y1="230" x2="80" y2="235" stroke="#fbbf24" stroke-width="1" opacity="0.6">
                            <animate attributeName="opacity" dur="1s" repeatCount="indefinite" values="0.6;0.2;0.6"/>
                        </line>
                        <line x1="85" y1="228" x2="90" y2="233" stroke="#fbbf24" stroke-width="1" opacity="0.5">
                            <animate attributeName="opacity" dur="1.2s" repeatCount="indefinite" values="0.5;0.1;0.5"/>
                        </line>
                        <line x1="95" y1="230" x2="100" y2="235" stroke="#fbbf24" stroke-width="1" opacity="0.7">
                            <animate attributeName="opacity" dur="0.8s" repeatCount="indefinite" values="0.7;0.3;0.7"/>
                        </line>
                        <line x1="105" y1="228" x2="110" y2="233" stroke="#fbbf24" stroke-width="1" opacity="0.4">
                            <animate attributeName="opacity" dur="1.5s" repeatCount="indefinite" values="0.4;0.1;0.4"/>
                        </line>
                        <line x1="115" y1="230" x2="120" y2="235" stroke="#fbbf24" stroke-width="1" opacity="0.6">
                            <animate attributeName="opacity" dur="1.1s" repeatCount="indefinite" values="0.6;0.2;0.6"/>
                        </line>
                    </g>
                </svg>

                <style>
                /* Animasi Gelembung Air Mendidih */
                @keyframes boilingBubble1 {
                    0% { transform: translateY(0) scale(1); opacity: 0.8; }
                    50% { opacity: 1; }
                    100% { transform: translateY(-30px) scale(1.5); opacity: 0; }
                }
                @keyframes boilingBubble2 {
                    0% { transform: translateY(0) scale(1); opacity: 0.7; }
                    50% { opacity: 1; }
                    100% { transform: translateY(-35px) scale(1.3); opacity: 0; }
                }
                @keyframes boilingBubble3 {
                    0% { transform: translateY(0) scale(1); opacity: 0.6; }
                    50% { opacity: 1; }
                    100% { transform: translateY(-25px) scale(1.4); opacity: 0; }
                }
                @keyframes boilingBubble4 {
                    0% { transform: translateY(0) scale(1); opacity: 0.8; }
                    50% { opacity: 1; }
                    100% { transform: translateY(-30px) scale(1.2); opacity: 0; }
                }
                @keyframes boilingBubble5 {
                    0% { transform: translateY(0) scale(1); opacity: 0.7; }
                    50% { opacity: 1; }
                    100% { transform: translateY(-20px) scale(1.6); opacity: 0; }
                }
                @keyframes boilingBubble6 {
                    0% { transform: translateY(0) scale(1); opacity: 0.6; }
                    50% { opacity: 1; }
                    100% { transform: translateY(-35px) scale(1.1); opacity: 0; }
                }
                @keyframes boilingBubble7 {
                    0% { transform: translateY(0) scale(1); opacity: 0.8; }
                    50% { opacity: 1; }
                    100% { transform: translateY(-30px) scale(1.3); opacity: 0; }
                }
                @keyframes boilingBubble8 {
                    0% { transform: translateY(0) scale(1); opacity: 0.7; }
                    50% { opacity: 1; }
                    100% { transform: translateY(-25px) scale(1.4); opacity: 0; }
                }

                .boiling-bubble:nth-of-type(3) { animation: boilingBubble1 1.8s infinite ease-in-out; }
                .boiling-bubble:nth-of-type(4) { animation: boilingBubble2 2.2s infinite 0.3s ease-in-out; }
                .boiling-bubble:nth-of-type(5) { animation: boilingBubble3 1.6s infinite 0.6s ease-in-out; }
                .boiling-bubble:nth-of-type(6) { animation: boilingBubble4 2.0s infinite 0.9s ease-in-out; }
                .boiling-bubble:nth-of-type(7) { animation: boilingBubble5 1.9s infinite 1.2s ease-in-out; }
                .boiling-bubble:nth-of-type(8) { animation: boilingBubble6 2.1s infinite 0.4s ease-in-out; }
                .boiling-bubble:nth-of-type(9) { animation: boilingBubble7 1.7s infinite 0.7s ease-in-out; }
                .boiling-bubble:nth-of-type(10) { animation: boilingBubble8 2.3s infinite 1.0s ease-in-out; }

                /* Efek Panas */
                .heat-effect line {
                    filter: blur(0.5px);
                }

                /* Efek Api */
                .fire-main {
                    filter: blur(0.3px);
                }
                .fire-secondary {
                    filter: blur(0.2px);
                }
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
            <span class="absolute top-5 right-5 bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full border border-blue-100 shadow-sm">
                {{ $item->published_at ? date('d M Y', strtotime($item->published_at)) : '' }}
            </span>
            @if($item->image)
                <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-40 object-cover rounded-lg mb-4">
            @endif
            <h3 class="text-lg md:text-xl font-extrabold mb-3 text-blue-700 leading-snug line-clamp-2">{{ $item->title }}</h3>
            <p class="text-sm text-gray-700 flex-1 mb-4 line-clamp-4">{{ ($item->content) }}</p>
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
// Water Wave Animation
class WaterWaveAnimation {
        constructor() {
        this.canvas = document.getElementById('waveCanvas');
        this.ctx = this.canvas.getContext('2d');
        this.waves = [];
        this.time = 0;
        this.resizeTimeout = null;
        this.randomBubbles = [];
        this.splashEffects = [];

        this.init();
        this.setupEventListeners();
        this.animate();
    }

    init() {
        this.resizeCanvas();
        this.createWaves();
        this.createRandomBubbles();
        this.createSplashEffects();
    }

    createWaves() {
        this.waves = [
            {
                amplitude: 15,
                frequency: 0.02,
                speed: 0.03,
                color: 'rgba(59, 130, 246, 0.3)',
                offset: 0
            },
            {
                amplitude: 12,
                frequency: 0.015,
                speed: 0.02,
                color: 'rgba(147, 197, 253, 0.4)',
                offset: Math.PI / 3
            },
            {
                amplitude: 8,
                frequency: 0.025,
                speed: 0.04,
                color: 'rgba(191, 219, 254, 0.3)',
                offset: Math.PI / 2
            }
        ];
    }

    createRandomBubbles() {
        this.randomBubbles = [];
        for (let i = 0; i < 15; i++) {
            this.randomBubbles.push({
                x: Math.random() * this.canvas.width,
                y: this.canvas.height + Math.random() * 50,
                size: 2 + Math.random() * 4,
                speed: 0.5 + Math.random() * 1.5,
                wobble: 0.02 + Math.random() * 0.03,
                opacity: 0.3 + Math.random() * 0.4,
                life: 0
            });
        }
    }

    createSplashEffects() {
        this.splashEffects = [];
        // Create initial splash effects
        for (let i = 0; i < 3; i++) {
            this.addSplashEffect(
                this.canvas.width * (0.3 + i * 0.2),
                this.canvas.height * 0.8
            );
        }
    }

    addSplashEffect(x, y) {
        const particles = [];
        const particleCount = 8 + Math.floor(Math.random() * 6);

        for (let i = 0; i < particleCount; i++) {
            particles.push({
                x: x + (Math.random() - 0.5) * 20,
                y: y,
                vx: (Math.random() - 0.5) * 3,
                vy: -2 - Math.random() * 3,
                size: 1 + Math.random() * 2,
                life: 0,
                maxLife: 30 + Math.random() * 20
            });
        }

        this.splashEffects.push({
            particles: particles,
            life: 0,
            maxLife: 50
        });
    }

    resizeCanvas() {
        const container = this.canvas.parentElement;
        const rect = container.getBoundingClientRect();

        this.canvas.width = rect.width;
        this.canvas.height = rect.height;

        // Set canvas display size
        this.canvas.style.width = rect.width + 'px';
        this.canvas.style.height = rect.height + 'px';

        // Recreate effects after resize
        this.createRandomBubbles();
        this.createSplashEffects();
    }

    setupEventListeners() {
        window.addEventListener('resize', () => {
            clearTimeout(this.resizeTimeout);
            this.resizeTimeout = setTimeout(() => {
                this.resizeCanvas();
            }, 100);
        });

        // Add click event for interactive splash effects
        this.canvas.addEventListener('click', (e) => {
            const rect = this.canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            this.addSplashEffect(x, y);
        });
    }

    drawWave(wave, yOffset = 0) {
        this.ctx.beginPath();
        this.ctx.strokeStyle = wave.color;
        this.ctx.lineWidth = 2;

        const centerY = this.canvas.height * 0.7 + yOffset;

        for (let x = 0; x <= this.canvas.width; x += 2) {
            const waveX = x * wave.frequency + this.time * wave.speed + wave.offset;
            const y = centerY + Math.sin(waveX) * wave.amplitude;

            if (x === 0) {
                this.ctx.moveTo(x, y);
            } else {
                this.ctx.lineTo(x, y);
            }
        }

        this.ctx.stroke();
    }

    drawRipples() {
        const centerX = this.canvas.width * 0.8;
        const centerY = this.canvas.height * 0.6;

        for (let i = 0; i < 3; i++) {
            const radius = 20 + i * 15 + Math.sin(this.time * 0.05) * 5;
            const opacity = 0.3 - i * 0.1;

            this.ctx.beginPath();
            this.ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
            this.ctx.strokeStyle = `rgba(59, 130, 246, ${opacity})`;
            this.ctx.lineWidth = 1;
            this.ctx.stroke();
        }
    }

        drawBubbles() {
        // Bubble groups with different behaviors
        const bubbleGroups = [
            {
                count: 12,
                startX: this.canvas.width * 0.1,
                endX: this.canvas.width * 0.4,
                startY: this.canvas.height * 0.9,
                endY: this.canvas.height * 0.3,
                sizeRange: { min: 2, max: 6 },
                speed: 0.02,
                wobble: 0.03
            },
            {
                count: 8,
                startX: this.canvas.width * 0.6,
                endX: this.canvas.width * 0.9,
                startY: this.canvas.height * 0.8,
                endY: this.canvas.height * 0.2,
                sizeRange: { min: 3, max: 8 },
                speed: 0.015,
                wobble: 0.025
            },
            {
                count: 6,
                startX: this.canvas.width * 0.3,
                endX: this.canvas.width * 0.7,
                startY: this.canvas.height * 0.95,
                endY: this.canvas.height * 0.1,
                sizeRange: { min: 1, max: 4 },
                speed: 0.03,
                wobble: 0.04
            }
        ];

        bubbleGroups.forEach((group, groupIndex) => {
            for (let i = 0; i < group.count; i++) {
                // Calculate bubble position with smooth movement
                const progress = (this.time * group.speed + i * 0.5) % 1;
                const x = group.startX + (group.endX - group.startX) * progress;
                const y = group.startY - (group.startY - group.endY) * progress;

                // Add wobble effect
                const wobbleX = Math.sin(this.time * group.wobble + i * 0.8) * 15;
                const wobbleY = Math.cos(this.time * group.wobble * 0.7 + i * 1.2) * 10;

                // Dynamic size based on position and time
                const sizeProgress = Math.sin(this.time * 0.05 + i * 0.3) * 0.5 + 0.5;
                const size = group.sizeRange.min + (group.sizeRange.max - group.sizeRange.min) * sizeProgress;

                // Opacity based on position (more transparent at bottom)
                const opacityProgress = 1 - progress;
                const opacity = 0.3 + opacityProgress * 0.5;

                // Draw bubble with gradient effect
                this.drawBubble(x + wobbleX, y + wobbleY, size, opacity, groupIndex);
            }
        });
    }

    drawBubble(x, y, size, opacity, groupIndex) {
        // Create gradient for bubble
        const gradient = this.ctx.createRadialGradient(x, y, 0, x, y, size);

        // Different colors for different groups
        const colors = [
            ['rgba(147, 197, 253, 0.8)', 'rgba(191, 219, 254, 0.4)', 'rgba(219, 234, 254, 0.2)'],
            ['rgba(59, 130, 246, 0.7)', 'rgba(147, 197, 253, 0.3)', 'rgba(191, 219, 254, 0.1)'],
            ['rgba(96, 165, 250, 0.6)', 'rgba(147, 197, 253, 0.2)', 'rgba(191, 219, 254, 0.05)']
        ];

        const colorSet = colors[groupIndex % colors.length];
        gradient.addColorStop(0, colorSet[0]);
        gradient.addColorStop(0.7, colorSet[1]);
        gradient.addColorStop(1, colorSet[2]);

        // Draw main bubble
        this.ctx.beginPath();
        this.ctx.arc(x, y, size, 0, 2 * Math.PI);
        this.ctx.fillStyle = gradient;
        this.ctx.fill();

        // Draw bubble highlight
        const highlightSize = size * 0.3;
        const highlightX = x - size * 0.3;
        const highlightY = y - size * 0.3;

        this.ctx.beginPath();
        this.ctx.arc(highlightX, highlightY, highlightSize, 0, 2 * Math.PI);
        this.ctx.fillStyle = 'rgba(255, 255, 255, 0.6)';
        this.ctx.fill();

        // Draw bubble outline
        this.ctx.beginPath();
        this.ctx.arc(x, y, size, 0, 2 * Math.PI);
        this.ctx.strokeStyle = `rgba(255, 255, 255, ${opacity * 0.5})`;
        this.ctx.lineWidth = 0.5;
        this.ctx.stroke();
    }

    drawRandomBubbles() {
        this.randomBubbles.forEach((bubble, index) => {
            // Update bubble position
            bubble.y -= bubble.speed;
            bubble.x += Math.sin(this.time * bubble.wobble) * 2;
            bubble.life += 1;

            // Reset bubble when it reaches the top
            if (bubble.y < -bubble.size) {
                bubble.y = this.canvas.height + Math.random() * 50;
                bubble.x = Math.random() * this.canvas.width;
                bubble.life = 0;
            }

            // Draw bubble with pulsing effect
            const pulseSize = bubble.size + Math.sin(this.time * 0.1 + index) * 0.5;
            const pulseOpacity = bubble.opacity + Math.sin(this.time * 0.15 + index) * 0.1;

            this.ctx.beginPath();
            this.ctx.arc(bubble.x, bubble.y, pulseSize, 0, 2 * Math.PI);
            this.ctx.fillStyle = `rgba(147, 197, 253, ${pulseOpacity})`;
            this.ctx.fill();

            // Draw bubble highlight
            const highlightSize = pulseSize * 0.4;
            this.ctx.beginPath();
            this.ctx.arc(bubble.x - pulseSize * 0.3, bubble.y - pulseSize * 0.3, highlightSize, 0, 2 * Math.PI);
            this.ctx.fillStyle = 'rgba(255, 255, 255, 0.4)';
            this.ctx.fill();
        });
    }

    drawSplashEffects() {
        this.splashEffects.forEach((splash, splashIndex) => {
            splash.life += 1;

            splash.particles.forEach((particle, particleIndex) => {
                // Update particle physics
                particle.x += particle.vx;
                particle.y += particle.vy;
                particle.vy += 0.1; // Gravity
                particle.life += 1;

                // Calculate opacity based on life
                const lifeProgress = particle.life / particle.maxLife;
                const opacity = 1 - lifeProgress;

                if (opacity > 0) {
                    // Draw particle
                    this.ctx.beginPath();
                    this.ctx.arc(particle.x, particle.y, particle.size * (1 - lifeProgress * 0.5), 0, 2 * Math.PI);
                    this.ctx.fillStyle = `rgba(147, 197, 253, ${opacity * 0.6})`;
                    this.ctx.fill();

                    // Draw particle trail
                    this.ctx.beginPath();
                    this.ctx.moveTo(particle.x, particle.y);
                    this.ctx.lineTo(particle.x - particle.vx * 2, particle.y - particle.vy * 2);
                    this.ctx.strokeStyle = `rgba(147, 197, 253, ${opacity * 0.3})`;
                    this.ctx.lineWidth = 1;
                    this.ctx.stroke();
                }
            });

            // Remove splash effect when expired
            if (splash.life > splash.maxLife) {
                this.splashEffects.splice(splashIndex, 1);
            }
        });

        // Randomly add new splash effects
        if (Math.random() < 0.02) {
            this.addSplashEffect(
                Math.random() * this.canvas.width,
                this.canvas.height * 0.8
            );
        }
    }

    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        // Draw waves
        this.waves.forEach((wave, index) => {
            this.drawWave(wave, index * 10);
        });

        // Draw ripples
        this.drawRipples();

        // Draw bubbles
        this.drawBubbles();

        // Draw random bubbles
        this.drawRandomBubbles();

        // Draw splash effects
        this.drawSplashEffects();

        this.time += 1;
        requestAnimationFrame(() => this.animate());
    }
}

// Initialize water wave animation when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new WaterWaveAnimation();
});

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
