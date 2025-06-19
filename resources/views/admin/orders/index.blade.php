@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Daftar Pesanan</h1>

<div class="bg-white p-6 rounded-lg shadow">
    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left pb-4">No. Pesanan</th>
                <th class="text-left pb-4">Pelanggan</th>
                <th class="text-left pb-4">Total</th>
                <th class="text-left pb-4">Status</th>
                <th class="text-left pb-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
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
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <select name="status" class="p-2 border rounded" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection