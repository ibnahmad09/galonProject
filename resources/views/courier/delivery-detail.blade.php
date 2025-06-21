@extends('layouts.courier')

@section('title', 'Detail Pengiriman')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('courier.deliveries') }}">Semua Pengiriman</a></li>
    <li class="breadcrumb-item active">Detail Pengiriman</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Informasi Pengiriman -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-truck me-2"></i>
                    Informasi Pengiriman
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tracking Number</label>
                            <p class="form-control-plaintext">{{ $delivery->tracking_number }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Order Number</label>
                            <p class="form-control-plaintext">#{{ $delivery->order->order_number }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Pengiriman</label>
                            <div>
                                @php
                                    $statusClass = 'status-' . $delivery->status;
                                    $statusText = ucwords(str_replace('_', ' ', $delivery->status));
                                @endphp
                                <span class="status-badge {{ $statusClass }} fs-6">{{ $statusText }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Pengiriman</label>
                            <p class="form-control-plaintext">{{ $delivery->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Terakhir Diupdate</label>
                            <p class="form-control-plaintext">{{ $delivery->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                        @if($delivery->notes)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan</label>
                            <p class="form-control-plaintext">{{ $delivery->notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Customer -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    Informasi Customer
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Customer</label>
                            <p class="form-control-plaintext">{{ $delivery->order->user->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <p class="form-control-plaintext">{{ $delivery->order->user->email }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor Telepon</label>
                            <p class="form-control-plaintext">
                                <a href="tel:{{ $delivery->order->user->phone }}" class="text-decoration-none">
                                    {{ $delivery->order->user->phone }}
                                </a>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Pengiriman</label>
                            <p class="form-control-plaintext">{{ $delivery->order->delivery_address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Pesanan -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Detail Pesanan
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($delivery->order->orderDetails as $detail)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            @if($detail->product->image)
                                                <img src="{{ asset('storage/' . $detail->product->image) }}"
                                                     alt="{{ $detail->product->name }}"
                                                     class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-box text-white"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <strong>{{ $detail->product->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $detail->product->category }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $detail->quantity }}</span>
                                </td>
                                <td>Rp {{ number_format($detail->product->price * $detail->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong>Rp {{ number_format($delivery->order->total_price, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Update Status -->
        @if(in_array($delivery->status, ['assigned', 'picked_up', 'on_way']))
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Update Status Pengiriman
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('courier.update-delivery-status', $delivery->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Status Saat Ini</label>
                        <input type="text" class="form-control"
                               value="{{ ucwords(str_replace('_', ' ', $delivery->status)) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Baru</label>
                        <select name="status" class="form-select" required>
                            @if($delivery->status == 'assigned')
                                <option value="picked_up">Picked Up - Barang telah diambil</option>
                                <option value="on_way">On The Way - Sedang dalam perjalanan</option>
                                <option value="delivered">Delivered - Barang telah diterima customer</option>
                                <option value="failed">Failed - Pengiriman gagal</option>
                            @elseif($delivery->status == 'picked_up')
                                <option value="on_way">On The Way - Sedang dalam perjalanan</option>
                                <option value="delivered">Delivered - Barang telah diterima customer</option>
                                <option value="failed">Failed - Pengiriman gagal</option>
                            @elseif($delivery->status == 'on_way')
                                <option value="delivered">Delivered - Barang telah diterima customer</option>
                                <option value="failed">Failed - Pengiriman gagal</option>
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="notes" class="form-control" rows="4"
                                  placeholder="Tambahkan catatan tentang pengiriman ini...">{{ $delivery->notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>
                        Update Status
                    </button>
                </form>
            </div>
        </div>
        @endif

        <!-- Timeline Status -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Timeline Pengiriman
                </h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Pengiriman Dibuat</h6>
                            <small class="text-muted">{{ $delivery->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>

                    @if($delivery->status != 'pending')
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Diterima Kurir</h6>
                            <small class="text-muted">{{ $delivery->updated_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>
                    @endif

                    @if(in_array($delivery->status, ['picked_up', 'on_way', 'delivered', 'failed']))
                    <div class="timeline-item">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Barang Diambil</h6>
                            <small class="text-muted">Status: Picked Up</small>
                        </div>
                    </div>
                    @endif

                    @if(in_array($delivery->status, ['on_way', 'delivered', 'failed']))
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Dalam Perjalanan</h6>
                            <small class="text-muted">Status: On The Way</small>
                        </div>
                    </div>
                    @endif

                    @if($delivery->status == 'delivered')
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Pengiriman Selesai</h6>
                            <small class="text-muted">Status: Delivered</small>
                        </div>
                    </div>
                    @endif

                    @if($delivery->status == 'failed')
                    <div class="timeline-item">
                        <div class="timeline-marker bg-danger"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Pengiriman Gagal</h6>
                            <small class="text-muted">Status: Failed</small>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #e9ecef;
}

.timeline-content {
    padding-left: 10px;
}
</style>
@endsection
