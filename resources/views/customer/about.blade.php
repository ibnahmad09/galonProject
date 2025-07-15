@extends('layouts.customer')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-b from-blue-50 to-white py-14 md:py-20">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-10">
        <div class="flex-1 max-w-xl mb-8 md:mb-0">
            <h1 class="text-3xl md:text-5xl font-extrabold text-blue-900 mb-4 leading-tight">Tentang <span class="text-blue-700">Air rebus Suci</span></h1>
            <p class="text-lg md:text-xl text-blue-900/80 mb-6">Kami adalah solusi air minum sehat, dan higienis untuk keluarga Indonesia. Mengutamakan pelayanan, kepercayaan, dan inovasi dalam setiap tetes air yang kami antarkan.</p>
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

<!-- Visi Misi Section -->
<div class="container mx-auto py-10">
    <div class="grid md:grid-cols-2 gap-10">
        <div>
            <h2 class="text-xl font-bold text-blue-800 mb-3">Visi</h2>
            <p class="text-gray-700 text-base">Menjadi penyedia air minum isi ulang terbaik, terpercaya, dan terdepan dalam inovasi serta pelayanan di Indonesia.</p>
        </div>
        <div>
            <h2 class="text-xl font-bold text-blue-800 mb-3">Misi</h2>
            <ul class="list-disc ml-6 text-gray-700 text-base space-y-1">
                <li>Menyediakan air minum berkualitas tinggi dan higienis.</li>
                <li>Mengutamakan kepuasan dan kepercayaan pelanggan.</li>
                <li>Mengembangkan inovasi layanan dan teknologi.</li>
                <li>Berperan aktif dalam menjaga lingkungan.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Nilai Perusahaan Section -->
<div class="bg-blue-50 py-12">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-blue-900 mb-8 text-center">Nilai Perusahaan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-xl transition-all">
                <svg class="w-10 h-10 text-blue-600 mb-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 2C12 2 4 12.5 4 18C4 21.3137 7.13401 24 12 24C16.866 24 20 21.3137 20 18C20 12.5 12 2 12 2Z" stroke="#2563eb" stroke-width="2.5" fill="#fff"/><circle cx="12" cy="18" r="3" fill="#fff" stroke="#2563eb" stroke-width="2.5"/></svg>
                <h3 class="font-bold text-lg text-blue-900 mb-1">Kualitas</h3>
                <p class="text-gray-600 text-sm">Selalu menjaga standar kualitas air dan layanan terbaik.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-xl transition-all">
                <svg class="w-10 h-10 text-blue-600 mb-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="10" rx="5" stroke="#2563eb" stroke-width="2.5" fill="#fff"/><path d="M7 12h10" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round"/></svg>
                <h3 class="font-bold text-lg text-blue-900 mb-1">Pelayanan</h3>
                <p class="text-gray-600 text-sm">Melayani pelanggan dengan sepenuh hati dan profesional.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-xl transition-all">
                <svg class="w-10 h-10 text-blue-600 mb-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" stroke="#2563eb" stroke-width="2.5" fill="#fff"/></svg>
                <h3 class="font-bold text-lg text-blue-900 mb-1">Inovasi</h3>
                <p class="text-gray-600 text-sm">Terus berinovasi untuk memberikan solusi terbaik.</p>
            </div>
        </div>
    </div>
</div>

<!-- Kontak Section -->
<div class="container mx-auto py-12">
    <h2 class="text-xl font-bold text-blue-800 mb-4">Kontak Kami</h2>
    <div class="flex flex-col md:flex-row gap-8">
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.52l.3 1.2a2 2 0 01-.45 1.95l-.7.7a16 16 0 006.36 6.36l.7-.7a2 2 0 011.95-.45l1.2.3A2 2 0 0021 18.72V21a2 2 0 01-2 2h-1C7.82 23 1 16.18 1 8V7a2 2 0 012-2z"/></svg>
                <span class="text-gray-700">+62 812-3456-7890</span>
            </div>
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm0 0v1a4 4 0 01-8 0v-1"/></svg>
                <span class="text-gray-700">info@airgalonsuci.com</span>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 12.414a2 2 0 00-2.828 0l-4.243 4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="text-gray-700">Rokan IV Koto, Rokan Hulu, Riau</span>
            </div>
        </div>
        <div class="flex-1">
            <div class="bg-blue-100 rounded-2xl p-6 h-full flex flex-col items-center justify-center">
                <div class="text-blue-700 font-bold text-lg mb-2">Jam Operasional</div>
                <div class="text-gray-700">Sabtu - Kamis: 08:00 - 18:00</div>
                <div class="text-gray-700">Jumat: Offline</div>
            </div>
        </div>
    </div>
</div>
@endsection
