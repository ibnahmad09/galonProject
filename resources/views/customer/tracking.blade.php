@extends('layouts.customer')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white min-h-screen py-10">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-2xl md:text-3xl font-bold text-blue-900 mb-8 text-center">Tracking Pengiriman</h1>

            @if($delivery)
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <!-- Header Info -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Tracking #{{ $delivery->tracking_number }}</h2>
                        <p class="text-gray-600">Order #{{ $delivery->order->order_number }}</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'assigned' => 'bg-blue-100 text-blue-800',
                                'picked_up' => 'bg-green-100 text-green-800',
                                'on_way' => 'bg-purple-100 text-purple-800',
                                'delivered' => 'bg-green-100 text-green-800',
                                'failed' => 'bg-red-100 text-red-800'
                            ];
                        @endphp
                        <span class="px-4 py-2 rounded-full text-sm font-medium {{ $statusColors[$delivery->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucwords(str_replace('_', ' ', $delivery->status)) }}
                        </span>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Pengiriman</h3>
                    <div class="relative">
                        @php
                            $statuses = [
                                'pending' => ['label' => 'Menunggu Pengiriman', 'icon' => 'clock', 'color' => 'text-yellow-600', 'bg' => 'bg-yellow-100'],
                                'assigned' => ['label' => 'Diterima Admin', 'icon' => 'check-circle', 'color' => 'text-blue-600', 'bg' => 'bg-blue-100'],
                                'picked_up' => ['label' => 'Barang Diambil', 'icon' => 'box', 'color' => 'text-purple-600', 'bg' => 'bg-purple-100'],
                                'on_way' => ['label' => 'Dalam Perjalanan', 'icon' => 'truck', 'color' => 'text-indigo-600', 'bg' => 'bg-indigo-100'],
                                'delivered' => ['label' => 'Terkirim', 'icon' => 'check-double', 'color' => 'text-green-600', 'bg' => 'bg-green-100'],
                                'failed' => ['label' => 'Gagal Dikirim', 'icon' => 'times-circle', 'color' => 'text-red-600', 'bg' => 'bg-red-100']
                            ];
                            $currentStatus = $delivery->status;
                        @endphp

                        <div class="space-y-6">
                            @foreach($statuses as $status => $info)
                                @php
                                    $isActive = array_search($currentStatus, array_keys($statuses)) >= array_search($status, array_keys($statuses));
                                    $isCurrent = $currentStatus === $status;
                                @endphp
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center w-12 h-12 rounded-full {{ $isActive ? $info['bg'] : 'bg-gray-100' }} border-2 {{ $isActive ? 'border-blue-300' : 'border-gray-200' }}">
                                            <i class="fas fa-{{ $info['icon'] }} text-lg {{ $isActive ? $info['color'] : 'text-gray-400' }}"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center">
                                            <h4 class="text-sm font-medium {{ $isActive ? 'text-gray-900' : 'text-gray-500' }}">
                                                {{ $info['label'] }}
                                            </h4>
                                            @if($isCurrent)
                                                <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Saat Ini</span>
                                            @endif
                                        </div>
                                        @if($isActive)
                                            <p class="text-xs text-gray-500 mt-1">
                                                @if($status === 'pending')
                                                    Pesanan sedang menunggu untuk diproses
                                                @elseif($status === 'assigned')
                                                    Admin telah menerima pengiriman
                                                @elseif($status === 'picked_up')
                                                    Barang telah diambil dari gudang
                                                @elseif($status === 'on_way')
                                                    Barang sedang dalam perjalanan ke alamat Anda
                                                @elseif($status === 'delivered')
                                                    Barang telah berhasil dikirim ke alamat Anda
                                                @elseif($status === 'failed')
                                                    Pengiriman gagal, akan dijadwalkan ulang
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                    @if(!$loop->last)
                                        <div class="ml-4 flex-shrink-0">
                                            <div class="w-0.5 h-8 {{ $isActive ? 'bg-blue-300' : 'bg-gray-200' }}"></div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-3">Detail Pesanan</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Pembayaran:</span>
                                <span class="font-medium">Rp {{ number_format($delivery->order->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Pesanan:</span>
                                <span class="font-medium">{{ $delivery->order->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Metode Pembayaran:</span>
                                <span class="font-medium">{{ ucfirst($delivery->order->payment_method) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-3">Alamat Pengiriman</h4>
                        <div class="text-sm text-gray-600">
                            <p class="font-medium text-gray-800">{{ $delivery->order->user->name }}</p>
                            <p>{{ $delivery->order->user->phone }}</p>
                            <p class="mt-2">{{ $delivery->order->shipping_address }}</p>
                        </div>
                    </div>
                </div>

                @if($delivery->notes)
                <div class="mt-6 bg-blue-50 rounded-lg p-4">
                    <h4 class="font-semibold text-blue-800 mb-2">Catatan Pengiriman</h4>
                    <p class="text-sm text-blue-700">{{ $delivery->notes }}</p>
                </div>
                @endif

                <!-- Item List -->
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-800 mb-3">Item Pesanan</h4>
                    <div class="space-y-3">
                        @foreach($delivery->order->details as $item)
                        <div class="flex items-center bg-white border border-gray-200 rounded-lg p-3">
                            @if($item->product->image)
                                <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded-lg">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-box text-gray-400"></i>
                                </div>
                            @endif
                            <div class="ml-3 flex-1">
                                <h5 class="font-medium text-gray-900">{{ $item->product->name }}</h5>
                                <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-900">Rp {{ number_format($item->price_at_order, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="text-center py-20">
                <div class="mb-6">
                    <i class="fas fa-search text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Tracking Number Tidak Ditemukan</h3>
                <p class="text-gray-500 mb-6">Mohon periksa kembali tracking number Anda</p>
                <a href="{{ route('customer.order.history') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                    Kembali ke Riwayat Pesanan
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
