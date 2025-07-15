@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail Pengiriman</h1>
            <p class="text-gray-600">{{ $delivery->tracking_number }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.deliveries') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informasi Pengiriman -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pengiriman</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tracking Number</label>
                        <p class="text-lg font-mono text-gray-900">{{ $delivery->tracking_number }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Pengiriman</label>
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
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$delivery->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucwords(str_replace('_', ' ', $delivery->status)) }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Dibuat</label>
                        <p class="text-sm text-gray-900">{{ $delivery->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                        <p class="text-sm text-gray-900">{{ $delivery->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                @if($delivery->notes)
                <div class="border-t pt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Kurir</label>
                    <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded">{{ $delivery->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Informasi Pesanan -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pesanan</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Order Number</label>
                        <p class="text-lg font-medium text-gray-900">#{{ $delivery->order->order_number }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Pesanan</label>
                        @php
                            $orderStatusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'processing' => 'bg-blue-100 text-blue-800',
                                'delivered' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800'
                            ];
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium {{ $orderStatusColors[$delivery->order->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($delivery->order->status) }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($delivery->order->total_price, 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($delivery->order->payment_method) }}</p>
                    </div>
                </div>

                <!-- Detail Item -->
                <div class="border-t pt-4">
                    <h3 class="text-lg font-medium mb-3">Item Pesanan</h3>

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
                                @foreach($delivery->order->details as $detail)
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
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Informasi Customer -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Customer</h2>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <p class="text-sm text-gray-900">{{ $delivery->order->user->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="text-sm text-gray-900">{{ $delivery->order->user->email }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telepon</label>
                        <p class="text-sm text-gray-900">{{ $delivery->order->user->phone }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                        <p class="text-sm text-gray-900">{{ $delivery->order->delivery_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Update Status Pengiriman -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Update Status Pengiriman</h2>

                @if(in_array($delivery->status, ['assigned', 'picked_up', 'on_way']))
                    <form action="{{ route('admin.delivery.updateStatus', $delivery->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                            <select name="status" id="status" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="assigned" {{ $delivery->status == 'assigned' ? 'selected' : '' }}>
                                    Assigned
                                </option>
                                <option value="picked_up" {{ $delivery->status == 'picked_up' ? 'selected' : '' }}>
                                    Picked Up
                                </option>
                                <option value="on_way" {{ $delivery->status == 'on_way' ? 'selected' : '' }}>
                                    On The Way
                                </option>
                                <option value="delivered" {{ $delivery->status == 'delivered' ? 'selected' : '' }}>
                                    Delivered
                                </option>
                                <option value="failed" {{ $delivery->status == 'failed' ? 'selected' : '' }}>
                                    Failed
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                            <textarea name="notes" id="notes" rows="3"
                                      class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Tambahkan catatan pengiriman...">{{ $delivery->notes }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            <i class="fas fa-save mr-2"></i>
                            Update Status
                        </button>
                    </form>
                @elseif($delivery->status == 'pending')
                    <div class="text-center py-4">
                        <i class="fas fa-clock text-yellow-400 text-3xl mb-2"></i>
                        <p class="text-gray-500 text-sm mb-3">Pengiriman masih pending</p>
                        <form action="{{ route('admin.delivery.accept', $delivery->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 text-sm">
                                <i class="fas fa-check mr-2"></i>
                                Terima Pengiriman
                            </button>
                        </form>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle text-green-400 text-3xl mb-2"></i>
                        <p class="text-gray-500 text-sm">Pengiriman sudah selesai</p>
                        <p class="text-sm text-gray-400 mt-1">
                            Status: {{ ucwords(str_replace('_', ' ', $delivery->status)) }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
