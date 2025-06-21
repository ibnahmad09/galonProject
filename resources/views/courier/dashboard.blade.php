@extends('layouts.courier')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <!-- Statistik Cards -->
    <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $activeDeliveries->count() }}</h4>
                        <p class="mb-0">Pengiriman Aktif</p>
                    </div>
                    <div class="fs-1">
                        <i class="fas fa-truck"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $completedToday }}</h4>
                        <p class="mb-0">Selesai Hari Ini</p>
                    </div>
                    <div class="fs-1">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $monthlyDeliveries }}</h4>
                        <p class="mb-0">Total Bulan Ini</p>
                    </div>
                    <div class="fs-1">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pengiriman Aktif -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-truck me-2"></i>
                    Pengiriman Aktif
                </h5>
                <a href="{{ route('courier.deliveries') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($activeDeliveries->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Tracking</th>
                                    <th>Customer</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activeDeliveries as $delivery)
                                <tr>
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
                                        {{ $delivery->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('courier.delivery-detail', $delivery->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateStatusModal{{ $delivery->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Update Status -->
                                <div class="modal fade" id="updateStatusModal{{ $delivery->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Status Pengiriman</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('courier.update-delivery-status', $delivery->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="status" class="form-select" required>
                                                            <option value="assigned" {{ $delivery->status == 'assigned' ? 'selected' : '' }}>
                                                                Assigned
                                                            </option>
                                                            <option value="picked_up" {{ $delivery->status == 'picked_up' ? 'selected' : '' }}>
                                                                Picked Up
                                                            </option>
                                                            <option value="on_way" {{ $delivery->status == 'on_way' ? 'selected' : '' }}>
                                                                On The Way
                                                            </option>
                                                            <option value="delivered" {{ $delivery->status == 'delivered' ? 'selected' : '' }}>
                                                                Delivered
                                                            </option>
                                                            <option value="failed" {{ $delivery->status == 'failed' ? 'selected' : '' }}>
                                                                Failed
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Catatan (Opsional)</label>
                                                        <textarea name="notes" class="form-control" rows="3"
                                                                  placeholder="Tambahkan catatan jika diperlukan">{{ $delivery->notes }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-truck fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada pengiriman aktif</h5>
                        <p class="text-muted">Anda dapat melihat pengiriman yang tersedia untuk diterima</p>
                        <a href="{{ route('courier.available-deliveries') }}" class="btn btn-primary">
                            Lihat Pengiriman Tersedia
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Notifikasi Terbaru -->
@if($notifications->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bell me-2"></i>
                    Notifikasi Terbaru
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $notification->title }}</div>
                            <small class="text-muted">{{ $notification->message }}</small>
                        </div>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
