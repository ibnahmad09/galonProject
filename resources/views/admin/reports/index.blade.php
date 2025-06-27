@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Laporan Keuangan</h1>
    <form method="GET" action="" id="reportForm" class="mb-6 flex flex-wrap gap-4 items-end">
        <div>
            <label class="block font-semibold">Jenis Laporan</label>
            <select name="type" id="type" class="form-select" required>
                <option value="sales">Laporan Penjualan</option>
                <option value="income">Laporan Pendapatan</option>
                <option value="deliveries">Laporan Pengiriman</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold">Periode</label>
            <select name="period" id="period" class="form-select" required>
                <option value="daily">Harian</option>
                <option value="monthly">Bulanan</option>
                <option value="yearly">Tahunan</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold">Tanggal</label>
            <input type="date" name="date" id="date" class="form-input" value="{{ request('date', now()->toDateString()) }}">
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tampilkan</button>
        </div>
        <div>
            <button type="button" id="exportPdfBtn" class="bg-green-600 text-white px-4 py-2 rounded">Export PDF</button>
        </div>
    </form>
    <div id="reportResult">
        {!! $resultView ?? '' !!}
    </div>
</div>
<script>
    document.getElementById('exportPdfBtn').onclick = function() {
        const type = document.getElementById('type').value;
        const period = document.getElementById('period').value;
        const date = document.getElementById('date').value;
        const url = `{{ route('admin.reports.exportPdf') }}?type=${type}&period=${period}&date=${date}`;
        window.open(url, '_blank');
    };
</script>
@endsection
