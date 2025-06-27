<div class="overflow-x-auto">
    <h2 class="text-lg font-bold mb-2">Laporan Penjualan</h2>
    <p class="mb-2">Periode: {{ ucfirst($period) }} | Tanggal: {{ $date }}</p>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-2 py-1">No</th>
                <th class="border px-2 py-1">Tanggal</th>
                <th class="border px-2 py-1">Nomor Pesanan</th>
                <th class="border px-2 py-1">Customer</th>
                <th class="border px-2 py-1">Total Harga</th>
                <th class="border px-2 py-1">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                <td class="border px-2 py-1">{{ $order->created_at->format('Y-m-d') }}</td>
                <td class="border px-2 py-1">{{ $order->order_number ?? $order->id }}</td>
                <td class="border px-2 py-1">{{ $order->user->name ?? '-' }}</td>
                <td class="border px-2 py-1">Rp{{ number_format($order->total_price,0,',','.') }}</td>
                <td class="border px-2 py-1">{{ ucfirst($order->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
