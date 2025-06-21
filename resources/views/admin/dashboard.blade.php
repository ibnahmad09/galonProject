@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <!-- Total Pesanan -->
    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Total Pesanan</p>
                <p class="text-2xl font-bold">{{ $totalOrders }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0V15m0 0h6m-6 0H6" />
            </svg>
        </div>
    </div>

    <!-- Total Produk -->
    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Total Produk</p>
                <p class="text-2xl font-bold">{{ $totalProducts }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
        </div>
    </div>

    <!-- Pesanan Pending -->
    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Pesanan Pending</p>
                <p class="text-2xl font-bold">{{ $pendingOrders }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <!-- Pengiriman Pending -->
    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Pengiriman Pending</p>
                <p class="text-2xl font-bold">{{ $pendingDeliveries }}</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
        </div>
    </div>
</div>

<!-- Statistik Pengiriman -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
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
<div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.orders') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center">
            <i class="fas fa-shopping-cart text-2xl mb-2"></i>
            <p class="font-semibold">Kelola Pesanan</p>
            <p class="text-sm opacity-90">Lihat dan kelola semua pesanan</p>
        </a>
        <a href="{{ route('admin.deliveries') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center">
            <i class="fas fa-truck text-2xl mb-2"></i>
            <p class="font-semibold">Kelola Pengiriman</p>
            <p class="text-sm opacity-90">Monitor status pengiriman</p>
        </a>
        <a href="{{ route('admin.products') }}" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center">
            <i class="fas fa-box text-2xl mb-2"></i>
            <p class="font-semibold">Kelola Produk</p>
            <p class="text-sm opacity-90">Tambah dan edit produk</p>
        </a>
    </div>
</div>

<!-- Daftar Pesanan Terbaru -->
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Pesanan Terbaru</h2>
        <a href="{{ route('admin.orders') }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">No. Pesanan</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Pelanggan</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Total</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Status</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Pengiriman</th>
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
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'processing' => 'bg-blue-100 text-blue-800',
                                'delivered' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800'
                            ];
                        @endphp
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
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
                            <span class="text-gray-400 text-sm">-</span>
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
