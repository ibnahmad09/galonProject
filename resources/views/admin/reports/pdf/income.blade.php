<h2 style="text-align:center;">Laporan Pendapatan</h2>
<p>Periode: {{ ucfirst($period) }} | Tanggal: {{ $date }}</p>
<table width="100%" border="1" cellspacing="0" cellpadding="4">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nomor Pesanan</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->created_at->format('Y-m-d') }}</td>
            <td>{{ $order->order_number ?? $order->id }}</td>
            <td>Rp{{ number_format($order->total_price,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" style="text-align:right;">Total Pendapatan</th>
            <th>Rp{{ number_format($totalIncome,0,',','.') }}</th>
        </tr>
    </tfoot>
</table>
