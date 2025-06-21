@extends('layouts.courier')

@section('title', 'Semua Pengiriman')

@section('breadcrumb')
    <li class="breadcrumb-item active">Semua Pengiriman</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Semua Pengiriman
                </h5>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" style="width: auto;" id="statusFilter">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="assigned">Assigned</option>
                        <option value="picked_up">Picked Up</option>
                        <option value="on_way">On The Way</option>
                        <option value="delivered">Delivered</option>
                        <option value="failed">Failed</option>
                    </select>
                    <input type="text" class="form-control form-control-sm" id="searchInput"
                           placeholder="Cari tracking number..." style="width: 200px;">
                </div>
            </div>
            <div class="card-body">
                @if($deliveries->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover" id="deliveriesTable">
                            <thead>
                                <tr>
                                    <th>No. Tracking</th>
                                    <th>Customer</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Total Item</th>
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
                                        {{ Str::limit($delivery->order->delivery_address, 50) }}
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
                                        <br>
                                        <small class="text-muted">{{ $delivery->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $delivery->order->orderDetails->count() }} item
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('courier.delivery-detail', $delivery->id) }}"
                                               class="btn btn-sm btn-outline-primary" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(in_array($delivery->status, ['assigned', 'picked_up', 'on_way']))
                                                <button type="button" class="btn btn-sm btn-outline-success"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateStatusModal{{ $delivery->id }}"
                                                        title="Update Status">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Update Status -->
                                @if(in_array($delivery->status, ['assigned', 'picked_up', 'on_way']))
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
                                                        <label class="form-label">Tracking Number</label>
                                                        <input type="text" class="form-control" value="{{ $delivery->tracking_number }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Customer</label>
                                                        <input type="text" class="form-control" value="{{ $delivery->order->user->name }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Status Saat Ini</label>
                                                        <input type="text" class="form-control" value="{{ ucwords(str_replace('_', ' ', $delivery->status)) }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Status Baru</label>
                                                        <select name="status" class="form-select" required>
                                                            @if($delivery->status == 'assigned')
                                                                <option value="picked_up">Picked Up</option>
                                                                <option value="on_way">On The Way</option>
                                                                <option value="delivered">Delivered</option>
                                                                <option value="failed">Failed</option>
                                                            @elseif($delivery->status == 'picked_up')
                                                                <option value="on_way">On The Way</option>
                                                                <option value="delivered">Delivered</option>
                                                                <option value="failed">Failed</option>
                                                            @elseif($delivery->status == 'on_way')
                                                                <option value="delivered">Delivered</option>
                                                                <option value="failed">Failed</option>
                                                            @endif
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
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $deliveries->links() }}
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-truck fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada pengiriman</h5>
                        <p class="text-muted">Anda belum memiliki pengiriman yang ditugaskan</p>
                        <a href="{{ route('courier.available-deliveries') }}" class="btn btn-primary">
                            Lihat Pengiriman Tersedia
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Filter by status
    $('#statusFilter').change(function() {
        var status = $(this).val();
        var search = $('#searchInput').val();
        filterTable(status, search);
    });

    // Search by tracking number
    $('#searchInput').keyup(function() {
        var status = $('#statusFilter').val();
        var search = $(this).val();
        filterTable(status, search);
    });

    function filterTable(status, search) {
        $('#deliveriesTable tbody tr').each(function() {
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
});
</script>
@endsection
