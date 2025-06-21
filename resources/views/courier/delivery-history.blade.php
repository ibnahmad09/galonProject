@extends('layouts.courier')

@section('title', 'Riwayat Pengiriman')

@section('breadcrumb')
    <li class="breadcrumb-item active">Riwayat Pengiriman</li>
@endsection

@section('content')
<div class="row">
    <!-- Statistik Riwayat -->
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h4 class="mb-0">{{ $deliveries->where('status', 'delivered')->count() }}</h4>
                <p class="mb-0">Berhasil Dikirim</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-danger text-white">
            <div class="card-body text-center">
                <h4 class="mb-0">{{ $deliveries->where('status', 'failed')->count() }}</h4>
                <p class="mb-0">Gagal Dikirim</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <h4 class="mb-0">{{ $deliveries->count() }}</h4>
                <p class="mb-0">Total Riwayat</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <h4 class="mb-0">{{ $deliveries->where('status', 'delivered')->count() > 0 ? round(($deliveries->where('status', 'delivered')->count() / $deliveries->count()) * 100, 1) : 0 }}%</h4>
                <p class="mb-0">Tingkat Keberhasilan</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-history me-2"></i>
                    Riwayat Pengiriman
                </h5>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" style="width: auto;" id="statusFilter">
                        <option value="">Semua Status</option>
                        <option value="delivered">Berhasil</option>
                        <option value="failed">Gagal</option>
                    </select>
                    <input type="text" class="form-control form-control-sm" id="searchInput"
                           placeholder="Cari tracking number..." style="width: 200px;">
                </div>
            </div>
            <div class="card-body">
                @if($deliveries->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover" id="historyTable">
                            <thead>
                                <tr>
                                    <th>No. Tracking</th>
                                    <th>Customer</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Total Item</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deliveries as $delivery)
                                <tr data-status="{{ $delivery->status }}"
                                    data-tracking="{{ $delivery->tracking_number }}">
                                    <td>
                                        <strong>{{ $delivery->tracking_number }}</strong>
                                        <br>
                                        <small class="text-muted">#{{ $delivery->order->order_number }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ $delivery->order->user->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $delivery->order->user->phone }}</small>
                                    </td>
                                    <td>
                                        {{ Str::limit($delivery->order->shipping_address, 50) }}
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = 'status-' . $delivery->status;
                                            $statusText = ucwords(str_replace('_', ' ', $delivery->status));
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        {{ $delivery->updated_at->format('d/m/Y H:i') }}
                                        <br>
                                        <small class="text-muted">{{ $delivery->updated_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $delivery->order->orderDetails->count() }} item
                                        </span>
                                    </td>
                                    <td>
                                        @if($delivery->notes)
                                            <span class="text-muted" title="{{ $delivery->notes }}">
                                                {{ Str::limit($delivery->notes, 30) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('courier.delivery-detail', $delivery->id) }}"
                                           class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $deliveries->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-history fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">Belum ada riwayat pengiriman</h4>
                        <p class="text-muted">Riwayat pengiriman akan muncul setelah Anda menyelesaikan pengiriman</p>
                        <a href="{{ route('courier.dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Grafik Statistik (jika ada data) -->
@if($deliveries->count() > 0)
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie me-2"></i>
                    Statistik Status Pengiriman
                </h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>
                    Pengiriman per Bulan
                </h5>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Filter functionality
    $('#statusFilter').change(function() {
        var status = $(this).val();
        var search = $('#searchInput').val();
        filterTable(status, search);
    });

    $('#searchInput').keyup(function() {
        var status = $('#statusFilter').val();
        var search = $(this).val();
        filterTable(status, search);
    });

    function filterTable(status, search) {
        $('#historyTable tbody tr').each(function() {
            var row = $(this);
            var rowStatus = row.data('status');
            var rowTracking = row.data('tracking');

            var statusMatch = !status || rowStatus === status;
            var searchMatch = !search || rowTracking.toLowerCase().includes(search.toLowerCase());

            if (statusMatch && searchMatch) {
                row.show();
            } else {
                row.hide();
            }
        });
    }

    // Charts
    @if($deliveries->count() > 0)
    // Status Chart
    var statusCtx = document.getElementById('statusChart').getContext('2d');
    var statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Berhasil', 'Gagal'],
            datasets: [{
                data: [
                    {{ $deliveries->where('status', 'delivered')->count() }},
                    {{ $deliveries->where('status', 'failed')->count() }}
                ],
                backgroundColor: ['#28a745', '#dc3545'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Monthly Chart
    var monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    var monthlyData = @json($deliveries->groupBy(function($delivery) {
        return $delivery->updated_at->format('M Y');
    })->map->count());

    var monthlyChart = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(monthlyData),
            datasets: [{
                label: 'Jumlah Pengiriman',
                data: Object.values(monthlyData),
                backgroundColor: '#007bff',
                borderColor: '#0056b3',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    @endif
});
</script>
@endsection
