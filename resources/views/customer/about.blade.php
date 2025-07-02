@extends('layouts.customer')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-b from-blue-50 to-white py-14 md:py-20">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-10">
        <div class="flex-1 max-w-xl mb-8 md:mb-0">
            <h1 class="text-3xl md:text-5xl font-extrabold text-blue-900 mb-4 leading-tight">Tentang <span class="text-blue-700">Air Galon Suci</span></h1>
            <p class="text-lg md:text-xl text-blue-900/80 mb-6">Kami adalah solusi air minum berkualitas tinggi, sehat, dan higienis untuk keluarga Indonesia. Mengutamakan pelayanan, kepercayaan, dan inovasi dalam setiap tetes air yang kami antarkan.</p>
        </div>
        <div class="flex-1 flex justify-center">
            <!-- Ilustrasi SVG animasi tetesan air jatuh ke gelas -->
            <div class="relative w-[220px] h-[260px]">
                <svg viewBox="0 0 120 160" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                    <!-- Gelas -->
                    <rect x="20" y="60" width="80" height="80" rx="20" fill="#fff" stroke="#60a5fa" stroke-width="3"/>
                    <!-- Air -->
                    <rect x="25" y="110" width="70" height="25" rx="12" fill="#38bdf8" fill-opacity="0.7"/>
                    <!-- Tetesan air (animasi JS) -->
                    <circle id="drop" cx="60" cy="40" r="10" fill="#38bdf8"/>
                </svg>
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
                <span class="text-gray-700">Jl. Sumber Air No. 123, Jakarta</span>
            </div>
        </div>
        <div class="flex-1">
            <div class="bg-blue-100 rounded-2xl p-6 h-full flex flex-col items-center justify-center">
                <div class="text-blue-700 font-bold text-lg mb-2">Jam Operasional</div>
                <div class="text-gray-700">Senin - Jumat: 08:00 - 18:00</div>
                <div class="text-gray-700">Sabtu: 08:00 - 15:00</div>
                <div class="text-gray-700">Minggu: Tutup</div>
            </div>
        </div>
    </div>
</div>

<script>
// Animasi tetesan air jatuh ke gelas
function animateDrop() {
    const drop = document.getElementById('drop');
    if (!drop) return;
    drop.setAttribute('cy', '40');
    drop.style.opacity = 1;
    let y = 40;
    let frame = 0;
    function fall() {
        if (y < 110) {
            y += 3 + frame * 0.2;
            drop.setAttribute('cy', y);
            frame++;
            requestAnimationFrame(fall);
        } else {
            // Fade out
            let fade = 1;
            function fadeOut() {
                fade -= 0.07;
                drop.style.opacity = fade;
                if (fade > 0) requestAnimationFrame(fadeOut);
                else setTimeout(animateDrop, 700);
            }
            fadeOut();
        }
    }
    fall();
}
document.addEventListener('DOMContentLoaded', animateDrop);
</script>
@endsection