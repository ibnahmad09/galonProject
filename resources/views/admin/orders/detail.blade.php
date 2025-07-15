@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail Pesanan</h1>
            <p class="text-gray-600">#{{ $order->order_number }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.orders') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informasi Pesanan -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pesanan</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Pengiriman</label>
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
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium {{ $deliveryColors[$order->delivery->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucwords(str_replace('_', ' ', $order->delivery->status)) }}
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Siap Dikirim
                        </span>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Pesanan</label>
                        <p class="text-sm text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($order->payment_method) }}</p>
                    </div>
                </div>

                <!-- Link ke Pengiriman -->
                @if($order->delivery)
                <div class="border-t pt-4">
                    <h3 class="text-lg font-medium mb-3">Kelola Pengiriman</h3>
                    <a href="{{ route('admin.delivery.detail', $order->delivery->id) }}"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        <i class="fas fa-truck mr-2"></i>Update Status Pengiriman
                    </a>
                </div>
                @endif
            </div>

            <!-- Detail Item -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Item Pesanan</h2>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Produk</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Harga</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Jumlah</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($order->details as $detail)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        @if($detail->product->image)
                                            <img src="{{ asset('storage/' . $detail->product->image) }}"
                                                 alt="{{ $detail->product->name }}"
                                                 class="w-10 h-10 rounded object-cover mr-3">
                                        @else
                                            <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center mr-3">
                                                <i class="fas fa-box text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $detail->product->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $detail->product->category }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900">Rp {{ number_format($detail->price_at_order, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $detail->quantity }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">Rp {{ number_format($detail->price_at_order * $detail->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Informasi Customer -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Customer</h2>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <p class="text-sm text-gray-900">{{ $order->user->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="text-sm text-gray-900">{{ $order->user->email }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telepon</label>
                        <p class="text-sm text-gray-900">{{ $order->user->phone }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                        <p class="text-sm text-gray-900">{{ $order->delivery_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pengiriman</h2>

                @if($order->delivery)
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tracking Number</label>
                            <p class="text-sm font-mono text-gray-900">{{ $order->delivery->tracking_number }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status Pengiriman</label>
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
                            <span class="inline-block px-2 py-1 rounded-full text-xs font-medium {{ $deliveryColors[$order->delivery->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucwords(str_replace('_', ' ', $order->delivery->status)) }}
                            </span>
                        </div>

                        @if($order->delivery->notes)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catatan Pengiriman</label>
                            <p class="text-sm text-gray-900">{{ $order->delivery->notes }}</p>
                        </div>
                        @endif

                        <div class="pt-3">
                            <a href="{{ route('admin.delivery.detail', $order->delivery->id) }}"
                               class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm">
                                <i class="fas fa-truck mr-2"></i>Kelola Pengiriman
                            </a>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Belum ada informasi pengiriman</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
