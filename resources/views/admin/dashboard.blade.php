@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
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
</div>

<!-- Daftar Pesanan Terbaru -->
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Pesanan Terbaru</h2>
    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left pb-4">No. Pesanan</th>
                <th class="text-left pb-4">Pelanggan</th>
                <th class="text-left pb-4">Total</th>
                <th class="text-left pb-4">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentOrders as $order)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-4">{{ $order->order_number }}</td>
                <td>{{ $order->user->name }}</td>
                <td>Rp {{ number_format($order->total_price) }}</td>
                <td>
                    <span class="px-2 py-1 rounded {{ 
                        $order->status == 'pending' ? 'bg-yellow-200 text-yellow-800' :
                        ($order->status == 'delivered' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')
                    }}">
                        {{ $order->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection