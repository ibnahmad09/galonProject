<div class="overflow-x-auto">
    <h2 class="text-lg font-bold mb-2">Laporan Pengiriman</h2>
    <p class="mb-2">Periode: {{ ucfirst($period) }} | Tanggal: {{ $date }}</p>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="border px-2 py-1">No</th>
                <th class="border px-2 py-1">Tanggal</th>
                <th class="border px-2 py-1">Nomor Pengiriman</th>
                <th class="border px-2 py-1">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deliveries as $delivery)
            <tr>
                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                <td class="border px-2 py-1">{{ $delivery->created_at->format('Y-m-d') }}</td>
                <td class="border px-2 py-1">{{ $delivery->tracking_number ?? $delivery->id }}</td>
                <td class="border px-2 py-1">{{ ucfirst($delivery->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
