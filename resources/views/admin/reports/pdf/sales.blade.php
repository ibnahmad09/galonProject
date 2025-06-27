<h2 style="text-align:center;">Laporan Penjualan</h2>
<p>Periode: {{ ucfirst($period) }} | Tanggal: {{ $date }}</p>
<table width="100%" border="1" cellspacing="0" cellpadding="4">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nomor Pesanan</th>
            <th>Customer</th>
            <th>Total Harga</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->created_at->format('Y-m-d') }}</td>
            <td>{{ $order->order_number ?? $order->id }}</td>
            <td>{{ $order->user->name ?? '-' }}</td>
            <td>Rp{{ number_format($order->total_price,0,',','.') }}</td>
            <td>{{ ucfirst($order->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
