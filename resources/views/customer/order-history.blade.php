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
                    @if($order->delivery)
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'assigned' => 'bg-blue-100 text-blue-700',
                                'picked_up' => 'bg-purple-100 text-purple-700',
                                'on_way' => 'bg-indigo-100 text-indigo-700',
                                'delivered' => 'bg-green-100 text-green-700',
                                'failed' => 'bg-red-100 text-red-700'
                            ];
                        @endphp
                        <span class="text-xs px-3 py-1 rounded-full font-bold {{ $statusColors[$order->delivery->status] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ ucwords(str_replace('_', ' ', $order->delivery->status)) }}
                        </span>
                    @else
                        <span class="text-xs px-3 py-1 rounded-full font-bold bg-blue-100 text-blue-700">
                            Siap Dikirim
                    </span>
                    @endif
                </div>
                <div class="text-xs text-gray-500 mb-2">{{ date('d M Y, H:i', strtotime($order->created_at)) }}</div>
                <div class="mb-3">
                    <span class="font-semibold text-gray-700">Total:</span>
                    <span class="text-blue-700 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>

                <!-- Tracking Pengiriman -->
                @if($order->delivery)
                <div class="mb-4 p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-blue-900 text-sm">Tracking Pengiriman</span>
                        <span class="text-xs font-mono text-blue-700">{{ $order->delivery->tracking_number }}</span>
                    </div>

                    <!-- Status Timeline -->
                    <div class="mb-3">
                        @php
                            $statuses = [
                                'pending' => ['label' => 'Menunggu', 'icon' => 'clock', 'color' => 'text-yellow-600'],
                                'assigned' => ['label' => 'Siap Dikirim', 'icon' => 'check-circle', 'color' => 'text-blue-600'],
                                'picked_up' => ['label' => 'Diambil', 'icon' => 'box', 'color' => 'text-purple-600'],
                                'on_way' => ['label' => 'Dalam Perjalanan', 'icon' => 'truck', 'color' => 'text-indigo-600'],
                                'delivered' => ['label' => 'Terkirim', 'icon' => 'check-double', 'color' => 'text-green-600'],
                                'failed' => ['label' => 'Gagal', 'icon' => 'times-circle', 'color' => 'text-red-600']
                            ];
                            $currentStatus = $order->delivery->status;
                        @endphp

                        <div class="flex items-center space-x-2">
                            @foreach($statuses as $status => $info)
                                @php
                                    $isActive = array_search($currentStatus, array_keys($statuses)) >= array_search($status, array_keys($statuses));
                                    $isCurrent = $currentStatus === $status;
                                @endphp
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-full {{ $isActive ? 'bg-blue-100' : 'bg-gray-100' }}">
                                        <i class="fas fa-{{ $info['icon'] }} text-xs {{ $isActive ? $info['color'] : 'text-gray-400' }}"></i>
                                    </div>
                                    @if(!$loop->last)
                                        <div class="w-8 h-0.5 {{ $isActive ? 'bg-blue-300' : 'bg-gray-200' }}"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-2 text-center">
                            <span class="text-sm font-medium {{ $statuses[$currentStatus]['color'] }}">
                                {{ $statuses[$currentStatus]['label'] }}
                            </span>
                        </div>
                    </div>

                    @if($order->delivery->notes)
                    <div class="text-xs text-gray-600 bg-white p-2 rounded border">
                        <strong>Catatan:</strong> {{ $order->delivery->notes }}
                    </div>
                    @endif

                    <!-- Link Tracking Detail -->
                    <div class="mt-3 text-center">
                        <a href="{{ route('customer.tracking', $order->delivery->tracking_number) }}"
                           class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs rounded-full hover:bg-blue-700 transition-colors">
                            <i class="fas fa-search mr-1"></i>
                            Lihat Detail Tracking
                        </a>
                    </div>
                </div>
                @endif

                <div class="mb-2 text-sm font-semibold text-gray-700">Produk:</div>
                <div class="flex flex-col gap-2 mb-2">
                    @foreach($order->details as $item)
                    <div class="flex items-center gap-3 bg-blue-50 rounded-lg px-3 py-2">
                        @if($item->product->image)
                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded-lg border border-blue-100">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-box text-gray-400"></i>
                            </div>
                        @endif
                        <div class="flex-1">
                            <div class="font-bold text-blue-900 text-sm">{{ $item->product->name }}</div>
                            <div class="text-xs text-gray-500">Qty: {{ $item->quantity }}</div>
                        </div>
                        <div class="font-semibold text-blue-700 text-sm">Rp {{ number_format($item->price_at_order, 0, ',', '.') }}</div>
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
