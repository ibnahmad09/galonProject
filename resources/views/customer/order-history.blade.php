@extends('layouts.customer')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white min-h-screen py-10">
    <div class="container mx-auto">
        <h1 class="text-2xl md:text-3xl font-bold text-blue-900 mb-8 text-center">Riwayat Pesanan</h1>
        @if($orders->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            @foreach($orders as $order)
            <div class="order-card bg-white border border-blue-100 rounded-2xl shadow-sm hover:shadow-xl transition-all p-6 relative animate-fadeInUp">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-blue-800">#{{ $order->order_number }}</span>
                    <span class="text-xs px-3 py-1 rounded-full font-bold
                        @if($order->status == 'Selesai') bg-green-100 text-green-700
                        @elseif($order->status == 'Diproses') bg-yellow-100 text-yellow-700
                        @elseif($order->status == 'Dibatalkan') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-600 @endif">
                        {{ $order->status }}
                    </span>
                </div>
                <div class="text-xs text-gray-500 mb-2">{{ date('d M Y, H:i', strtotime($order->created_at)) }}</div>
                <div class="mb-3">
                    <span class="font-semibold text-gray-700">Total:</span>
                    <span class="text-blue-700 font-bold">Rp {{ number_format($order->total) }}</span>
                </div>
                <div class="mb-2 text-sm font-semibold text-gray-700">Produk:</div>
                <div class="flex flex-col gap-2 mb-2">
                    @foreach($order->orderDetails as $item)
                    <div class="flex items-center gap-3 bg-blue-50 rounded-lg px-3 py-2">
                        <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded-lg border border-blue-100">
                        <div class="flex-1">
                            <div class="font-bold text-blue-900 text-sm">{{ $item->product->name }}</div>
                            <div class="text-xs text-gray-500">Qty: {{ $item->quantity }}</div>
                        </div>
                        <div class="font-semibold text-blue-700 text-sm">Rp {{ number_format($item->price) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-20">
            <!-- Ilustrasi animasi SVG pesanan kosong -->
            <svg width="180" height="180" viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-6 animate-bounce-slow">
                <ellipse cx="90" cy="150" rx="60" ry="12" fill="#e0e7ff"/>
                <rect x="45" y="60" width="90" height="60" rx="16" fill="#fff" stroke="#60a5fa" stroke-width="3"/>
                <rect x="60" y="75" width="60" height="10" rx="5" fill="#bae6fd"/>
                <rect x="60" y="95" width="40" height="10" rx="5" fill="#e0e7ff"/>
                <rect x="60" y="115" width="30" height="8" rx="4" fill="#e0e7ff"/>
                <circle cx="70" cy="70" r="4" fill="#60a5fa"/>
                <circle cx="110" cy="70" r="4" fill="#60a5fa"/>
            </svg>
            <div class="text-blue-800 font-bold text-lg mb-2">Belum ada pesanan</div>
            <div class="text-gray-500 mb-4">Ayo pesan produk kami dan nikmati layanan terbaik!</div>
            <a href="{{ route('customer.products') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded shadow transition">Lihat Produk</a>
        </div>
        @endif
    </div>
</div>
<style>
@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(40px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-fadeInUp {
    animation: fadeInUp 0.7s cubic-bezier(.39,.575,.565,1.000) both;
}
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-18px); }
}
.animate-bounce-slow {
    animation: bounce-slow 2.2s infinite;
}
</style>
<script>
document.querySelectorAll('.order-card').forEach(card => {
    card.addEventListener('mousemove', function(e) {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = ((y - centerY) / centerY) * 8;
        const rotateY = ((x - centerX) / centerX) * -8;
        card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.03)`;
    });
    card.addEventListener('mouseleave', function() {
        card.style.transform = '';
    });
});
</script>
@endsection