@extends('layouts.courier')

@section('title', 'Profil Kurir')

@section('breadcrumb')
<li class="breadcrumb-item active">Profil</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Profile Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-user-cog me-2"></i>
                    Informasi Profil
                </h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('courier.profile.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label fw-bold">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label fw-bold">Role</label>
                            <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror"
                                  id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Bergabung Sejak</label>
                        <input type="text" class="form-control" value="{{ $user->created_at->format('d F Y') }}" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Change Password Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="fas fa-key me-2"></i>
                    Ubah Password
                </h5>
            </div>
            <div class="card-body">
                @if(session('password_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('password_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('courier.profile.password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-bold">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                               id="current_password" name="current_password" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-bold">Password Baru</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                               id="new_password" name="new_password" required>
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control"
                               id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key me-2"></i>
                        Ubah Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Statistics Card -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>
                    Statistik Pengiriman
                </h5>
            </div>
            <div class="card-body">
                @php
                    $courierId = auth()->id();
                    $totalDeliveries = \App\Models\Delivery::where('courier_id', $courierId)->count();
                    $completedDeliveries = \App\Models\Delivery::where('courier_id', $courierId)
                        ->where('status', 'delivered')->count();
                    $thisMonthDeliveries = \App\Models\Delivery::where('courier_id', $courierId)
                        ->where('status', 'delivered')
                        ->whereMonth('updated_at', now()->month)
                        ->count();
                @endphp
                <div class="row text-center">
                    <div class="col-4">
                        <div class="border-end">
                            <h4 class="text-primary mb-0">{{ $totalDeliveries }}</h4>
                            <small class="text-muted">Total</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="border-end">
                            <h4 class="text-success mb-0">{{ $completedDeliveries }}</h4>
                            <small class="text-muted">Selesai</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <h4 class="text-info mb-0">{{ $thisMonthDeliveries }}</h4>
                        <small class="text-muted">Bulan Ini</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
