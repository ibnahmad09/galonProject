<h2 style="text-align:center;">Laporan Pengiriman</h2>
<p>Periode: {{ ucfirst($period) }} | Tanggal: {{ $date }}</p>
<table width="100%" border="1" cellspacing="0" cellpadding="4">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nomor Pengiriman</th>
            <th>Kurir</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($deliveries as $delivery)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $delivery->created_at->format('Y-m-d') }}</td>
            <td>{{ $delivery->tracking_number ?? $delivery->id }}</td>
            <td>{{ $delivery->courier->name ?? '-' }}</td>
            <td>{{ ucfirst($delivery->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
