@extends('layouts.courier')

@section('title', 'Pengiriman Tersedia')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pengiriman Tersedia</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Pengiriman Tersedia
                </h5>
                <div class="d-flex gap-2">
                    <input type="text" class="form-control form-control-sm" id="searchInput"
                           placeholder="Cari tracking number..." style="width: 200px;">
                </div>
            </div>
            <div class="card-body">
                @if($availableDeliveries->count() > 0)
                    <div class="row">
                        @foreach($availableDeliveries as $delivery)
                        <div class="col-md-6 col-lg-4 mb-4 delivery-card"
                             data-tracking="{{ $delivery->tracking_number }}">
                            <div class="card h-100 border-primary">
                                <div class="card-header bg-primary text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">
                                            <i class="fas fa-truck me-2"></i>
                                            {{ $delivery->tracking_number }}
                                        </h6>
                                        <span class="badge bg-light text-dark">Tersedia</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Order #{{ $delivery->order->order_number }}</strong>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-user text-primary me-2"></i>
                                            <strong>{{ $delivery->order->user->name }}</strong>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            <span>{{ $delivery->order->user->phone }}</span>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-map-marker-alt text-primary me-2 mt-1"></i>
                                            <small>{{ Str::limit($delivery->order->delivery_address, 80) }}</small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Item Pesanan:</strong>
                                        <ul class="list-unstyled mt-2">
                                            @foreach($delivery->order->orderDetails as $detail)
                                            <li class="d-flex justify-content-between">
                                                <span>{{ $detail->product->name }}</span>
                                                <span class="badge bg-secondary">{{ $detail->quantity }}x</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Total Item:</span>
                                            <strong>{{ $delivery->order->orderDetails->count() }} item</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Total Harga:</span>
                                            <strong>Rp {{ number_format($delivery->order->total_price, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $delivery->created_at->diffForHumans() }}
                                        </small>
                                        <button type="button" class="btn btn-success btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#acceptDeliveryModal{{ $delivery->id }}">
                                            <i class="fas fa-check me-1"></i>
                                            Terima Pengiriman
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Accept Delivery -->
                        <div class="modal fade" id="acceptDeliveryModal{{ $delivery->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-check-circle me-2"></i>
                                            Terima Pengiriman
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Anda akan menerima pengiriman ini dan bertanggung jawab untuk mengirimkannya ke customer.
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Tracking Number:</strong>
                                                <p>{{ $delivery->tracking_number }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Order Number:</strong>
                                                <p>#{{ $delivery->order->order_number }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <strong>Customer:</strong>
                                            <p>{{ $delivery->order->user->name }} ({{ $delivery->order->user->phone }})</p>
                                        </div>

                                        <div class="mb-3">
                                            <strong>Alamat Pengiriman:</strong>
                                            <p>{{ $delivery->order->shipping_address }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <strong>Item yang akan dikirim:</strong>
                                            <ul class="list-group list-group-flush">
                                                @foreach($delivery->order->orderDetails as $detail)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>{{ $detail->product->name }}</span>
                                                    <span class="badge bg-primary">{{ $detail->quantity }}x</span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('courier.accept-delivery', $delivery->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check me-1"></i>
                                                Ya, Terima Pengiriman
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">Tidak ada pengiriman tersedia</h4>
                        <p class="text-muted">Semua pengiriman telah diterima oleh kurir lain atau belum ada pesanan baru</p>
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
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Search functionality
    $('#searchInput').keyup(function() {
        var search = $(this).val().toLowerCase();

        $('.delivery-card').each(function() {
            var tracking = $(this).data('tracking').toLowerCase();

            if (tracking.includes(search)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>
@endsection
