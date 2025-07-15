@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-6">
    <!-- Total Pesanan -->
    <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg flex items-center justify-between">
            <div>
            <p class="text-xs md:text-sm text-gray-500">Total Pesanan</p>
            <p class="text-lg md:text-2xl font-bold">{{ $totalOrders }}</p>
            </div>
        <div class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-full">
            <i class="fas fa-shopping-cart text-blue-500 text-xl md:text-2xl"></i>
        </div>
    </div>

    <!-- Total Produk -->
    <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg flex items-center justify-between">
            <div>
            <p class="text-xs md:text-sm text-gray-500">Total Produk</p>
            <p class="text-lg md:text-2xl font-bold">{{ $totalProducts }}</p>
            </div>
        <div class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-full">
            <i class="fas fa-box text-green-500 text-xl md:text-2xl"></i>
        </div>
    </div>

    <!-- Pengiriman Pending -->
    <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg flex items-center justify-between">
            <div>
            <p class="text-xs md:text-sm text-gray-500">Pengiriman Pending</p>
            <p class="text-lg md:text-2xl font-bold">{{ $pendingDeliveries }}</p>
            </div>
        <div class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 bg-yellow-100 rounded-full">
            <i class="fas fa-clock text-yellow-500 text-xl md:text-2xl"></i>
        </div>
    </div>

    <!-- Pengiriman Pending -->
    <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg flex items-center justify-between">
            <div>
            <p class="text-xs md:text-sm text-gray-500">Pengiriman Pending</p>
            <p class="text-lg md:text-2xl font-bold">{{ $pendingDeliveries }}</p>
            </div>
        <div class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 bg-orange-100 rounded-full">
            <i class="fas fa-truck text-orange-500 text-xl md:text-2xl"></i>
        </div>
    </div>
</div>

<!-- Statistik Pengiriman -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6">
    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Pengiriman Aktif</p>
                <p class="text-2xl font-bold">{{ $activeDeliveries }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Pengiriman Selesai</p>
                <p class="text-2xl font-bold">{{ $completedDeliveries }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Tingkat Keberhasilan</p>
                <p class="text-2xl font-bold">
                    {{ $completedDeliveries > 0 ? round(($completedDeliveries / ($completedDeliveries + $activeDeliveries + $pendingDeliveries)) * 100, 1) : 0 }}%
                </p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white p-4 md:p-6 rounded-xl shadow-lg mb-6">
    <h2 class="text-lg md:text-xl font-bold mb-4">Quick Actions</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.deliveries.quick-update') }}" class="bg-orange-500 hover:bg-orange-600 text-white p-4 rounded-xl flex flex-col items-center justify-center transition-all duration-200 shadow-md">
            <i class="fas fa-bolt text-2xl mb-2"></i>
            <span class="font-semibold text-sm md:text-base">Quick Update</span>
        </a>
        <a href="{{ route('admin.orders') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-xl flex flex-col items-center justify-center transition-all duration-200 shadow-md">
            <i class="fas fa-shopping-cart text-2xl mb-2"></i>
            <span class="font-semibold text-sm md:text-base">Kelola Pesanan</span>
        </a>
        <a href="{{ route('admin.deliveries') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-xl flex flex-col items-center justify-center transition-all duration-200 shadow-md">
            <i class="fas fa-truck text-2xl mb-2"></i>
            <span class="font-semibold text-sm md:text-base">Kelola Pengiriman</span>
        </a>
        <a href="{{ route('admin.products') }}" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-xl flex flex-col items-center justify-center transition-all duration-200 shadow-md">
            <i class="fas fa-box text-2xl mb-2"></i>
            <span class="font-semibold text-sm md:text-base">Kelola Produk</span>
        </a>
    </div>
</div>

<!-- Daftar Pesanan Terbaru -->
<div class="bg-white p-4 md:p-6 rounded-xl shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg md:text-xl font-bold">Pesanan Terbaru</h2>
        <a href="{{ route('admin.orders') }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Semua</a>
    </div>
    <!-- Mobile: Card, Desktop: Table -->
    <div class="block md:hidden space-y-4">
        @foreach($recentOrders as $order)
        <div class="border rounded-xl p-4 shadow hover:shadow-md transition-all duration-200">
            <div class="flex justify-between items-center mb-2">
                <div>
                    <div class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</div>
                    <div class="text-xs text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                    @if($order->delivery)
                        {{ [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'assigned' => 'bg-blue-100 text-blue-800',
                            'picked_up' => 'bg-green-100 text-green-800',
                            'on_way' => 'bg-purple-100 text-purple-800',
                            'delivered' => 'bg-green-100 text-green-800',
                            'failed' => 'bg-red-100 text-red-800'
                        ][$order->delivery->status] ?? 'bg-gray-100 text-gray-800' }}
                    @else
                        bg-blue-100 text-blue-800
                    @endif
                ">
                    {{ $order->delivery ? ucwords(str_replace('_', ' ', $order->delivery->status)) : 'Siap Dikirim' }}
                </span>
            </div>
            <div class="mb-2">
                <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                <div class="text-xs text-gray-500">{{ $order->user->phone }}</div>
            </div>
            <div class="mb-2 text-sm text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
            <div>
                <a href="{{ route('admin.order.detail', $order->id) }}"
                   class="text-blue-600 hover:text-blue-900 text-xs font-semibold">
                    <i class="fas fa-eye mr-1"></i>Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">No. Pesanan</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Pelanggan</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Total</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Status Pengiriman</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <div class="text-sm font-medium text-gray-900">{{ $order->order_number }}</div>
                        <div class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $order->user->phone }}</div>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="py-3 px-4">
                        @if($order->delivery)
                            @php
                                $deliveryColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'assigned' => 'bg-blue-100 text-blue-800',
                                    'picked_up' => 'bg-green-100 text-green-800',
                                    'on_way' => 'bg-purple-100 text-purple-800',
                                    'delivered' => 'bg-green-100 text-green-800',
                                    'failed' => 'bg-red-100 text-red-800'
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $deliveryColors[$order->delivery->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucwords(str_replace('_', ' ', $order->delivery->status)) }}
                            </span>
                        @else
                            <span class="text-blue-600 text-sm">Siap Dikirim</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        <a href="{{ route('admin.order.detail', $order->id) }}"
                           class="text-blue-600 hover:text-blue-900 text-sm">
                            <i class="fas fa-eye mr-1"></i>Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
