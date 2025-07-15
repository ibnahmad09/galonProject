@extends('layouts.customer')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-green-500 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Program Referral</h1>
            <p class="text-gray-600 text-lg">Bagikan kode referral Anda dan dapatkan diskon menarik</p>
        </div>

        <!-- Kode Referral Card -->
        <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-green-600 rounded-2xl p-6 md:p-8 mb-8 shadow-xl">
            <div class="text-center">
                <h3 class="text-xl md:text-2xl font-bold text-white mb-4">Kode Referral Anda</h3>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 md:p-6 mb-4">
                    <span class="text-3xl md:text-4xl font-mono font-bold text-white tracking-wider">{{ $stats['referral_code'] }}</span>
                </div>
                <button onclick="copyReferralCode()"
                        class="bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-xl font-semibold hover:bg-white/30 transition-all duration-300 border border-white/30">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Salin Kode
                </button>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <h4 class="text-sm md:text-base font-semibold text-gray-700 mb-1">Total Referral</h4>
                <p class="text-2xl md:text-3xl font-bold text-green-600">{{ $stats['referrals_count'] }}</p>
            </div>

            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <h4 class="text-sm md:text-base font-semibold text-gray-700 mb-1">Diskon Diberikan</h4>
                <p class="text-lg md:text-xl font-bold text-blue-600">Rp {{ number_format($stats['total_discount_given'], 0, ',', '.') }}</p>
            </div>

            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <h4 class="text-sm md:text-base font-semibold text-gray-700 mb-1">Diskon Diterima</h4>
                <p class="text-lg md:text-xl font-bold text-purple-600">Rp {{ number_format($stats['total_discount_received'], 0, ',', '.') }}</p>
            </div>

            <div class="bg-white rounded-2xl p-4 md:p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                    </div>
                </div>
                <h4 class="text-sm md:text-base font-semibold text-gray-700 mb-1">Diskon Tersedia</h4>
                <p class="text-2xl md:text-3xl font-bold text-yellow-600 mb-2">{{ $stats['available_discounts'] }}</p>
                @if($stats['available_discounts'] > 0)
                    <a href="{{ route('customer.referral.discounts') }}"
                       class="inline-block bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs md:text-sm hover:bg-yellow-600 transition-all duration-300">
                        Lihat Diskon
                    </a>
                @endif
            </div>
        </div>

        <!-- Informasi Program -->
        <div class="bg-white rounded-2xl p-6 md:p-8 mb-8 shadow-lg border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-gray-800">Bagaimana Program Referral Bekerja?</h3>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-white text-xs font-bold">1</span>
                        </div>
                        <p class="text-gray-700">Bagikan kode referral Anda kepada teman</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-white text-xs font-bold">2</span>
                        </div>
                        <p class="text-gray-700">Teman Anda akan mendapat diskon <span class="font-semibold text-green-600">Rp {{ number_format($settings->referred_discount_amount ?? 10000, 0, ',', '.') }}</span> pada order pertama</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-white text-xs font-bold">3</span>
                        </div>
                        <p class="text-gray-700">Anda akan mendapat diskon <span class="font-semibold text-purple-600">Rp {{ number_format($settings->referrer_discount_amount ?? 5000, 0, ',', '.') }}</span> yang dapat digunakan kapan saja</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-white text-xs font-bold">4</span>
                        </div>
                        <p class="text-gray-700">Diskon dapat digunakan tanpa minimum order</p>
                    </div>
                </div>
            </div>
        </div>

    
        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('customer.referral.history') }}"
               class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 md:p-6 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                <div class="flex items-center justify-center space-x-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="text-lg">Riwayat Referral</span>
                </div>
            </a>

            @if($stats['available_discounts'] > 0)
            <a href="{{ route('customer.referral.discounts') }}"
               class="bg-gradient-to-r from-green-500 to-blue-500 text-white p-4 md:p-6 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center">
                <div class="flex items-center justify-center space-x-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                    <span class="text-lg">Lihat Diskon ({{ $stats['available_discounts'] }})</span>
                </div>
            </a>
            @endif
        </div>
    </div>
</div>

<script>
function copyReferralCode() {
    const code = '{{ $stats["referral_code"] }}';
    navigator.clipboard.writeText(code).then(function() {
        // Show success notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300';
        notification.innerHTML = `
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Kode referral berhasil disalin!</span>
            </div>
        `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 2000);
    });
}

function shareWhatsApp() {
    const code = '{{ $stats["referral_code"] }}';
    const message = `Halo! Saya ingin berbagi kode referral saya: ${code}\n\nDapatkan diskon Rp {{ number_format($settings->referred_discount_amount ?? 10000, 0, ',', '.') }} untuk order pertama Anda dengan menggunakan kode referral ini!`;
    const url = `https://wa.me/?text=${encodeURIComponent(message)}`;
    window.open(url, '_blank');
}

function shareTelegram() {
    const code = '{{ $stats["referral_code"] }}';
    const message = `Halo! Saya ingin berbagi kode referral saya: ${code}\n\nDapatkan diskon Rp {{ number_format($settings->referred_discount_amount ?? 10000, 0, ',', '.') }} untuk order pertama Anda dengan menggunakan kode referral ini!`;
    const url = `https://t.me/share/url?url=${encodeURIComponent(window.location.origin)}&text=${encodeURIComponent(message)}`;
    window.open(url, '_blank');
}

function shareFacebook() {
    const code = '{{ $stats["referral_code"] }}';
    const message = `Halo! Saya ingin berbagi kode referral saya: ${code}\n\nDapatkan diskon Rp {{ number_format($settings->referred_discount_amount ?? 10000, 0, ',', '.') }} untuk order pertama Anda dengan menggunakan kode referral ini!`;
    const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.origin)}&quote=${encodeURIComponent(message)}`;
    window.open(url, '_blank');
}
</script>
@endsection
