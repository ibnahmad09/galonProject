@extends('layouts.admin')

@section('title', 'Quick Update Status Pengiriman')

@section('head')
<script>
// Global functions untuk quick update
window.quickUpdateStatus = function(deliveryId, newStatus) {
    const statusText = {
        'assigned': 'Assigned (Siap Dikirim)',
        'picked_up': 'Picked Up (Diambil)',
        'on_way': 'On The Way (Dalam Perjalanan)',
        'delivered': 'Delivered (Terkirim)',
        'failed': 'Failed (Gagal)'
    };

    if (!confirm(`Update status pengiriman menjadi "${statusText[newStatus]}"?`)) {
        return;
    }

    const notes = document.getElementById('notes-' + deliveryId).value;

    // Show loading
    document.getElementById('loadingOverlay').classList.remove('hidden');

    fetch(`/admin/deliveries/${deliveryId}/quick-update`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            status: newStatus,
            notes: notes
        })
    })
    .then(response => response.json())
    .then(data => {
        // Hide loading
        document.getElementById('loadingOverlay').classList.add('hidden');

        if (data.success) {
            // Show success toast
            document.getElementById('toastMessage').textContent = data.message;
            window.showToast();

            // Reload page after 1 second
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            alert('Gagal mengupdate status: ' + data.message);
        }
    })
    .catch(error => {
        document.getElementById('loadingOverlay').classList.add('hidden');
        alert('Terjadi kesalahan: ' + error.message);
    });
};

window.copyTracking = function(trackingNumber) {
    navigator.clipboard.writeText(trackingNumber).then(() => {
        // Show temporary success message
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.classList.remove('border-blue-300', 'text-blue-700');
        btn.classList.add('border-green-300', 'text-green-700');

        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('border-green-300', 'text-green-700');
            btn.classList.add('border-blue-300', 'text-blue-700');
        }, 1000);
    });
};

// Toast functions
window.showToast = function() {
    const toast = document.getElementById('successToast');
    toast.classList.remove('hidden');
    setTimeout(() => {
        window.hideToast();
    }, 3000);
};

window.hideToast = function() {
    document.getElementById('successToast').classList.add('hidden');
};
</script>
@endsection

@section('content')
<div class="container mx-auto px-4 py-4 md:py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
        <div class="flex-1">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                Quick Update Status
            </h1>
            <p class="text-gray-600 mt-1 text-sm md:text-base">Update status pengiriman dengan cepat untuk admin di lapangan</p>
        </div>
        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full md:w-auto">
            <a href="{{ route('admin.deliveries') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 text-center text-sm">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
            <button onclick="location.reload()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 text-center text-sm">
                <i class="fas fa-sync-alt mr-2"></i>
                Refresh
            </button>
        </div>
    </div>

    <!-- Alert Info -->
    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded-r-lg">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-500 mr-3 text-xl mt-0.5"></i>
            <div class="flex-1">
                <strong class="text-blue-800 text-sm md:text-base">Halaman Quick Update</strong> - Untuk admin yang sedang di lapangan.
                Update status pengiriman dengan cepat tanpa perlu membuka halaman detail.
                <br><span class="text-blue-600 text-xs md:text-sm">Halaman akan auto-refresh setiap 30 detik</span>
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-lg shadow-md p-4 md:p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-filter mr-1"></i>
                    Filter Status
                </label>
                <select id="statusFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option value="">📋 Semua Status</option>
                    <option value="assigned">📋 Assigned (Siap Dikirim)</option>
                    <option value="picked_up">📦 Picked Up (Diambil)</option>
                    <option value="on_way">🚚 On The Way (Dalam Perjalanan)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-search mr-1"></i>
                    Pencarian
                </label>
                <input type="text" id="searchInput" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                       placeholder="Cari tracking number atau nama customer...">
            </div>
        </div>
    </div>

    <!-- Statistik Cepat -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-6">
        <div class="bg-blue-500 text-white rounded-lg shadow-md p-3 md:p-4 text-center">
            <i class="fas fa-clock text-lg md:text-2xl mb-1 md:mb-2"></i>
            <h4 class="text-lg md:text-2xl font-bold mb-0" id="assignedCount">0</h4>
            <small class="text-xs md:text-sm">Assigned</small>
        </div>
        <div class="bg-green-500 text-white rounded-lg shadow-md p-3 md:p-4 text-center">
            <i class="fas fa-box text-lg md:text-2xl mb-1 md:mb-2"></i>
            <h4 class="text-lg md:text-2xl font-bold mb-0" id="pickedCount">0</h4>
            <small class="text-xs md:text-sm">Picked Up</small>
        </div>
        <div class="bg-yellow-500 text-white rounded-lg shadow-md p-3 md:p-4 text-center">
            <i class="fas fa-truck text-lg md:text-2xl mb-1 md:mb-2"></i>
            <h4 class="text-lg md:text-2xl font-bold mb-0" id="onwayCount">0</h4>
            <small class="text-xs md:text-sm">On The Way</small>
        </div>
        <div class="bg-indigo-500 text-white rounded-lg shadow-md p-3 md:p-4 text-center">
            <i class="fas fa-list text-lg md:text-2xl mb-1 md:mb-2"></i>
            <h4 class="text-lg md:text-2xl font-bold mb-0" id="totalCount">0</h4>
            <small class="text-xs md:text-sm">Total Aktif</small>
        </div>
    </div>

    <!-- Daftar Pengiriman -->
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6" id="deliveryList">
        @forelse($activeDeliveries as $delivery)
            <div class="delivery-item bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
                 data-status="{{ $delivery->status }}"
                 data-tracking="{{ $delivery->tracking_number }}"
                 data-customer="{{ $delivery->order->user->name }}">

                <!-- Header Card -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-3 md:p-4 rounded-t-lg">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-2 sm:space-y-0">
                        <div class="flex-1">
                            <h6 class="font-bold text-base md:text-lg">
                                <i class="fas fa-shipping-fast mr-2"></i>
                                #{{ $delivery->tracking_number }}
                            </h6>
                            <p class="text-blue-100 text-xs md:text-sm">{{ $delivery->order->order_number }}</p>
                        </div>
                        <span class="bg-white text-blue-600 px-2 md:px-3 py-1 rounded-full text-xs md:text-sm font-medium">
                            {{ ucwords(str_replace('_', ' ', $delivery->status)) }}
                        </span>
                    </div>
                </div>

                <!-- Body Card -->
                <div class="p-3 md:p-4">
                    <!-- Customer Info -->
                    <div class="mb-3 md:mb-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-user text-blue-500 mr-2 text-sm"></i>
                            <span class="font-semibold text-blue-600 text-sm md:text-base">{{ $delivery->order->user->name }}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-phone text-gray-500 mr-2 text-sm"></i>
                            <span class="text-gray-600 text-xs md:text-sm">{{ $delivery->order->user->phone }}</span>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mb-3 md:mb-4">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-red-500 mr-2 mt-1 text-sm"></i>
                            <span class="text-gray-600 text-xs md:text-sm">{{ Str::limit($delivery->order->delivery_address, 80) }}</span>
                        </div>
                    </div>

                    <!-- Order Details -->
                    <div class="mb-3 md:mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-xs md:text-sm">Total Order:</span>
                            <span class="font-bold text-green-600 text-sm md:text-base">Rp {{ number_format($delivery->order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($delivery->notes)
                        <div class="mb-3 md:mb-4">
                            <div class="flex items-start">
                                <i class="fas fa-sticky-note text-yellow-500 mr-2 mt-1 text-sm"></i>
                                <span class="text-gray-600 text-xs md:text-sm">{{ $delivery->notes }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Last Update -->
                    <div class="mb-3 md:mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-gray-500 mr-2 text-sm"></i>
                            <span class="text-gray-600 text-xs md:text-sm">Update: {{ $delivery->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="bg-gray-50 p-3 md:p-4 rounded-b-lg">
                    <!-- Status Buttons -->
                    <div class="grid grid-cols-2 gap-2 mb-3 md:mb-4">
                        <button type="button"
                                class="px-2 md:px-3 py-2 text-xs font-medium rounded-md border border-blue-300 text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200 {{ $delivery->status == 'assigned' ? 'bg-blue-500 text-white border-blue-500' : '' }}"
                                onclick="window.quickUpdateStatus('{{ $delivery->id }}', 'assigned')"
                                {{ $delivery->status == 'assigned' ? 'disabled' : '' }}>
                            <i class="fas fa-check mr-1"></i>
                            <span class="hidden sm:inline">Assigned</span>
                            <span class="sm:hidden">✓</span>
                        </button>
                        <button type="button"
                                class="px-2 md:px-3 py-2 text-xs font-medium rounded-md border border-green-300 text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors duration-200 {{ $delivery->status == 'picked_up' ? 'bg-green-500 text-white border-green-500' : '' }}"
                                onclick="window.quickUpdateStatus('{{ $delivery->id }}', 'picked_up')"
                                {{ $delivery->status == 'picked_up' ? 'disabled' : '' }}>
                            <i class="fas fa-box mr-1"></i>
                            <span class="hidden sm:inline">Picked Up</span>
                            <span class="sm:hidden">📦</span>
                        </button>
                        <button type="button"
                                class="px-2 md:px-3 py-2 text-xs font-medium rounded-md border border-yellow-300 text-yellow-700 bg-white hover:bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-colors duration-200 {{ $delivery->status == 'on_way' ? 'bg-yellow-500 text-white border-yellow-500' : '' }}"
                                onclick="window.quickUpdateStatus('{{ $delivery->id }}', 'on_way')"
                                {{ $delivery->status == 'on_way' ? 'disabled' : '' }}>
                            <i class="fas fa-truck mr-1"></i>
                            <span class="hidden sm:inline">On Way</span>
                            <span class="sm:hidden">🚚</span>
                        </button>
                        <button type="button"
                                class="px-2 md:px-3 py-2 text-xs font-medium rounded-md bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors duration-200"
                                onclick="window.quickUpdateStatus('{{ $delivery->id }}', 'delivered')">
                            <i class="fas fa-check-circle mr-1"></i>
                            <span class="hidden sm:inline">Delivered</span>
                            <span class="sm:hidden">✅</span>
                        </button>
                    </div>

                    <div class="mb-3 md:mb-4">
                        <button type="button"
                                class="w-full px-2 md:px-3 py-2 text-xs font-medium rounded-md border border-red-300 text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors duration-200"
                                onclick="window.quickUpdateStatus('{{ $delivery->id }}', 'failed')">
                            <i class="fas fa-times-circle mr-1"></i>
                            <span class="hidden sm:inline">Failed</span>
                            <span class="sm:hidden">❌</span>
                        </button>
                    </div>

                    <!-- Quick Notes -->
                    <div class="mb-3 md:mb-4">
                        <input type="text"
                               class="w-full border border-gray-300 rounded-md px-2 md:px-3 py-2 text-xs md:text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="📝 Catatan cepat (opsional)"
                               id="notes-{{ $delivery->id }}">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <a href="{{ route('admin.delivery.detail', $delivery->id) }}"
                           class="flex-1 px-2 md:px-3 py-2 text-xs font-medium rounded-md border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 text-center transition-colors duration-200">
                            <i class="fas fa-eye mr-1"></i>
                            <span class="hidden sm:inline">Detail</span>
                            <span class="sm:hidden">👁️</span>
                        </a>
                        <button type="button"
                                class="px-2 md:px-3 py-2 text-xs font-medium rounded-md border border-blue-300 text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200"
                                onclick="window.copyTracking('{{ $delivery->tracking_number }}')"
                                title="Copy tracking number">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-8 md:py-12">
                    <div class="mb-4 md:mb-6">
                        <i class="fas fa-truck text-gray-400 text-4xl md:text-6xl"></i>
                    </div>
                    <h3 class="text-gray-600 text-lg md:text-xl font-semibold mb-2 md:mb-3">Tidak ada pengiriman aktif</h3>
                    <p class="text-gray-500 mb-4 md:mb-6 text-sm md:text-base">Semua pengiriman sudah selesai atau belum ada yang diterima.</p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('admin.deliveries') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 md:px-6 py-2 rounded-lg transition-colors duration-200 text-center text-sm">
                            <i class="fas fa-list mr-2"></i>
                            Semua Pengiriman
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50">
    <div class="flex justify-center items-center h-full">
        <div class="text-center text-white">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white mx-auto mb-4"></div>
            <h5 class="mb-2 text-lg">Mengupdate Status...</h5>
            <p class="text-gray-300">Mohon tunggu sebentar</p>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div id="successToast" class="fixed bottom-4 right-4 bg-green-500 text-white px-4 md:px-6 py-3 md:py-4 rounded-lg shadow-lg hidden z-50 max-w-sm">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-3"></i>
        <div class="flex-1">
            <div class="font-semibold text-sm md:text-base">Berhasil!</div>
            <div id="toastMessage" class="text-xs md:text-sm">Status pengiriman berhasil diupdate</div>
        </div>
        <button onclick="window.hideToast()" class="ml-2 md:ml-4 text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

@endsection

<script>
// Update statistik
window.updateStats = function() {
    const items = document.querySelectorAll('.delivery-item');
    let assigned = 0, picked = 0, onway = 0;

    items.forEach(item => {
        if (item.style.display !== 'none') {
            const status = item.dataset.status;
            if (status === 'assigned') assigned++;
            else if (status === 'picked_up') picked++;
            else if (status === 'on_way') onway++;
        }
    });

    document.getElementById('assignedCount').textContent = assigned;
    document.getElementById('pickedCount').textContent = picked;
    document.getElementById('onwayCount').textContent = onway;
    document.getElementById('totalCount').textContent = assigned + picked + onway;
};

// Filter dan Search
document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('statusFilter');
    const searchInput = document.getElementById('searchInput');

    if (statusFilter) {
        statusFilter.addEventListener('change', window.filterDeliveries);
    }

    if (searchInput) {
        searchInput.addEventListener('input', window.filterDeliveries);
    }

    window.updateStats();
});

window.filterDeliveries = function() {
    const statusFilter = document.getElementById('statusFilter').value;
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const deliveryItems = document.querySelectorAll('.delivery-item');

    deliveryItems.forEach(item => {
        const status = item.dataset.status;
        const tracking = item.dataset.tracking.toLowerCase();
        const customer = item.dataset.customer.toLowerCase();

        const statusMatch = !statusFilter || status === statusFilter;
        const searchMatch = !searchInput ||
                          tracking.includes(searchInput) ||
                          customer.includes(searchInput);

        if (statusMatch && searchMatch) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });

    window.updateStats();
};

// Auto refresh setiap 30 detik
setInterval(() => {
    location.reload();
}, 30000);

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + R untuk refresh
    if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
        e.preventDefault();
        location.reload();
    }

    // Escape untuk hide loading
    if (e.key === 'Escape') {
        document.getElementById('loadingOverlay').classList.add('hidden');
    }
});
</script>
