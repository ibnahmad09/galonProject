@extends('layouts.customer')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Riwayat Pesanan</h2>
    
    <div class="space-y-4">
        @foreach($orders as $order)
        <div class="p-4 bg-gray-50 rounded-lg">
            <div class="flex justify-between mb-2">
                <div>
                    <p class="font-bold">No. Pesanan: {{ $order->order_number }}</p>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
                <span class="px-3 py-1 rounded {{ 
                    $order->status == 'pending' ? 'bg-yellow-200 text-yellow-800' :
                    ($order->status == 'delivered' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')
                }}">
                    {{ $order->status }}
                </span>
            </div>
            <div class="ml-4">
                @foreach($order->details as $detail)
                <div class="flex justify-between mb-2">
                    <p>{{ $detail->product->name }}</p>
                    <p>Rp {{ number_format($detail->price_at_order) }} x {{ $detail->quantity }}</p>
                </div>
                @endforeach
                <div class="flex justify-end font-bold">
                    Total: Rp {{ number_format($order->total_price) }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection