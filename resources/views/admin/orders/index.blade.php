@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header - Enhanced for Desktop & Mobile -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 md:p-8 mb-8 border border-blue-100 shadow-sm">
        <!-- Desktop Header -->
        <div class="hidden md:flex justify-between items-center">
            <div class="flex-1">
                <div class="flex items-center space-x-4 mb-3">
                    <div class="p-3 bg-blue-500 rounded-xl shadow-lg">
                        <i class="fas fa-shopping-cart text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-1">Manajemen Pesanan</h1>
                        <p class="text-gray-600 text-lg">Kelola dan pantau semua pesanan pelanggan</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.deliveries') }}"
                   class="group relative bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                    <i class="fas fa-truck text-lg"></i>
                    <span class="font-semibold">Lihat Pengiriman</span>
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 rounded-xl transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
        <!-- Mobile Header -->
        <div class="md:hidden">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500 rounded-full shadow-lg mb-4">
                    <i class="fas fa-shopping-cart text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Manajemen Pesanan</h1>
                <p class="text-gray-600 text-sm">Kelola dan pantau semua pesanan pelanggan</p>
            </div>
            <div class="grid grid-cols-1 gap-3">
                <a href="{{ route('admin.deliveries') }}"
                   class="group relative bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex flex-col items-center justify-center space-y-2">
                    <i class="fas fa-truck text-xl"></i>
                    <span class="font-semibold text-sm">Lihat Pengiriman</span>
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 rounded-xl transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik - Enhanced -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-blue-100 rounded-full -mr-10 -mt-10 opacity-50"></div>
            <div class="relative z-10 flex items-center">
                <div class="p-3 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl shadow-md">
                    <i class="fas fa-shopping-cart text-white text-lg md:text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm md:text-base text-gray-600 font-medium">Total Pesanan</p>
                    <p class="text-xl md:text-3xl font-bold text-blue-600">{{ $orders->total() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-100 rounded-full -mr-10 -mt-10 opacity-50"></div>
            <div class="relative z-10 flex items-center">
                <div class="p-3 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl shadow-md">
                    <i class="fas fa-clock text-white text-lg md:text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm md:text-base text-gray-600 font-medium">Pending</p>
                    <p class="text-xl md:text-3xl font-bold text-yellow-600">{{ $orders->getCollection()->where('delivery.status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -mr-10 -mt-10 opacity-50"></div>
            <div class="relative z-10 flex items-center">
                <div class="p-3 bg-gradient-to-br from-green-400 to-green-500 rounded-xl shadow-md">
                    <i class="fas fa-check text-white text-lg md:text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm md:text-base text-gray-600 font-medium">Selesai</p>
                    <p class="text-xl md:text-3xl font-bold text-green-600">{{ $orders->getCollection()->where('delivery.status', 'delivered')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-purple-100 rounded-full -mr-10 -mt-10 opacity-50"></div>
            <div class="relative z-10 flex items-center">
                <div class="p-3 bg-gradient-to-br from-purple-400 to-purple-500 rounded-xl shadow-md">
                    <i class="fas fa-truck text-white text-lg md:text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm md:text-base text-gray-600 font-medium">Dalam Pengiriman</p>
                    <p class="text-xl md:text-3xl font-bold text-purple-600">{{ $orders->getCollection()->whereIn('delivery.status', ['assigned', 'picked_up', 'on_way'])->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Pesanan -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Pesanan</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Pesanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pengiriman</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $order->order_number }}</div>
                            <div class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $order->user->phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
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
                                <div class="text-xs text-gray-500 mt-1">{{ $order->delivery->tracking_number }}</div>
                            @else
                                <span class="text-gray-400 text-sm">Belum ada pengiriman</span>
                            @endif
                        </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <!-- Tombol Detail -->
                                <a href="{{ route('admin.order.detail', $order->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs font-medium transition-colors duration-200"
                                   title="Lihat detail pesanan #{{ $order->order_number }}">
                                    <i class="fas fa-eye mr-1"></i>
                                    Detail
                                </a>

                                <!-- Tombol Pengiriman -->
                                @if($order->delivery)
                                <a href="{{ route('admin.delivery.detail', $order->delivery->id) }}"
                                   class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-medium transition-colors duration-200"
                                   title="Update status pengiriman #{{ $order->delivery->tracking_number }}">
                                    <i class="fas fa-truck mr-1"></i>
                                    Pengiriman
                                </a>
                                @else
                                <span class="bg-blue-300 text-blue-600 px-3 py-1 rounded text-xs font-medium">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Siap Dikirim
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $orders->links() }}
        </div>
    </div>
</div>

@endsection
