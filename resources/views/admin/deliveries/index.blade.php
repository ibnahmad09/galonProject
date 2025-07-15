@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-4 md:py-8">
    <!-- Header - Enhanced for Desktop & Mobile -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 md:p-8 mb-8 border border-blue-100 shadow-sm">
        <!-- Desktop Header -->
        <div class="hidden md:flex justify-between items-center">
            <div class="flex-1">
                <div class="flex items-center space-x-4 mb-3">
                    <div class="p-3 bg-blue-500 rounded-xl shadow-lg">
                        <i class="fas fa-truck text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-1">Manajemen Pengiriman</h1>
                        <p class="text-gray-600 text-lg">Kelola status pengiriman dan tracking pesanan dengan mudah</p>
                    </div>
                </div>
            </div>

            <!-- Desktop Action Buttons -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.deliveries.quick-update') }}"
                   class="group relative bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                    <i class="fas fa-bolt text-lg"></i>
                    <span class="font-semibold">Quick Update</span>
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 rounded-xl transition-opacity duration-300"></div>
                </a>

                <a href="{{ route('admin.orders') }}"
                   class="group relative bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center space-x-2">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span class="font-semibold">Lihat Pesanan</span>
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 rounded-xl transition-opacity duration-300"></div>
                </a>
            </div>
        </div>

        <!-- Mobile Header -->
        <div class="md:hidden">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500 rounded-full shadow-lg mb-4">
                    <i class="fas fa-truck text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Manajemen Pengiriman</h1>
                <p class="text-gray-600 text-sm">Kelola status pengiriman dan tracking pesanan</p>
            </div>

            <!-- Mobile Action Buttons Grid -->
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('admin.deliveries.quick-update') }}"
                   class="group relative bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white p-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex flex-col items-center justify-center space-y-2">
                    <i class="fas fa-bolt text-xl"></i>
                    <span class="font-semibold text-sm">Quick Update</span>
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 rounded-xl transition-opacity duration-300"></div>
                </a>



                <a href="{{ route('admin.orders') }}"
                   class="group relative bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex flex-col items-center justify-center space-y-2">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="font-semibold text-sm">Lihat Pesanan</span>
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 rounded-xl transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistik - Enhanced -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-100 rounded-full -mr-10 -mt-10 opacity-50"></div>
            <div class="relative z-10 flex items-center">
                <div class="p-3 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl shadow-md">
                    <i class="fas fa-clock text-white text-lg md:text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm md:text-base text-gray-600 font-medium">Menunggu</p>
                    <p class="text-xl md:text-3xl font-bold text-yellow-600">{{ $deliveries->where('status', 'pending')->count() }}</p>
                    <p class="text-xs text-gray-500 hidden md:block">Perlu ditindak lanjuti</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-blue-100 rounded-full -mr-10 -mt-10 opacity-50"></div>
            <div class="relative z-10 flex items-center">
                <div class="p-3 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl shadow-md">
                    <i class="fas fa-user-check text-white text-lg md:text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm md:text-base text-gray-600 font-medium">Diterima</p>
                    <p class="text-xl md:text-3xl font-bold text-blue-600">{{ $deliveries->where('status', 'assigned')->count() }}</p>
                    <p class="text-xs text-gray-500 hidden md:block">Siap diproses</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-purple-100 rounded-full -mr-10 -mt-10 opacity-50"></div>
            <div class="relative z-10 flex items-center">
                <div class="p-3 bg-gradient-to-br from-purple-400 to-purple-500 rounded-xl shadow-md">
                    <i class="fas fa-truck text-white text-lg md:text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm md:text-base text-gray-600 font-medium">Dalam Perjalanan</p>
                    <p class="text-xl md:text-3xl font-bold text-purple-600">{{ $deliveries->whereIn('status', ['picked_up', 'on_way'])->count() }}</p>
                    <p class="text-xs text-gray-500 hidden md:block">Sedang dikirim</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -mr-10 -mt-10 opacity-50"></div>
            <div class="relative z-10 flex items-center">
                <div class="p-3 bg-gradient-to-br from-green-400 to-green-500 rounded-xl shadow-md">
                    <i class="fas fa-check-circle text-white text-lg md:text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm md:text-base text-gray-600 font-medium">Selesai</p>
                    <p class="text-xl md:text-3xl font-bold text-green-600">{{ $deliveries->where('status', 'delivered')->count() }}</p>
                    <p class="text-xs text-gray-500 hidden md:block">Berhasil dikirim</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Pengiriman -->
    <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
        <div class="px-6 py-6 border-b border-gray-200 bg-gray-50">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-2 sm:space-y-0">
                <div>
                    <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Daftar Pengiriman</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola semua pengiriman dalam satu tempat</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-list mr-1"></i>
                        Total: <span class="font-semibold">{{ $deliveries->total() }}</span> pengiriman
                    </div>
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-eye mr-1"></i>
                        Menampilkan: <span class="font-semibold">{{ $deliveries->count() }}</span> item
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="block md:hidden">
            @foreach($deliveries as $delivery)
            <div class="border-b border-gray-200 p-4 hover:bg-gray-50 transition-colors duration-200">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-sm font-medium text-gray-900">{{ $delivery->tracking_number }}</span>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'assigned' => 'bg-blue-100 text-blue-800',
                                    'picked_up' => 'bg-green-100 text-green-800',
                                    'on_way' => 'bg-purple-100 text-purple-800',
                                    'delivered' => 'bg-green-100 text-green-800',
                                    'failed' => 'bg-red-100 text-red-800'
                                ];
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$delivery->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucwords(str_replace('_', ' ', $delivery->status)) }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-600 mb-1">
                            <i class="fas fa-shopping-cart mr-1"></i>#{{ $delivery->order->order_number }}
                        </div>
                        <div class="text-sm text-gray-600 mb-1">
                            <i class="fas fa-user mr-1"></i>{{ $delivery->order->user->name }}
                        </div>
                        <div class="text-sm text-gray-600 mb-2">
                            <i class="fas fa-phone mr-1"></i>{{ $delivery->order->user->phone }}
                        </div>
                        <div class="text-sm font-medium text-green-600">
                            Rp {{ number_format($delivery->order->total_price, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 text-right">
                        {{ $delivery->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                <!-- Action Buttons Mobile -->
                <div class="flex flex-wrap gap-2 mt-3">
                    <a href="{{ route('admin.delivery.detail', $delivery->id) }}"
                       class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full hover:bg-blue-200 transition-colors duration-200">
                        <i class="fas fa-eye mr-1"></i>
                        Detail
                    </a>

                    @if($delivery->status == 'pending')
                    <form action="{{ route('admin.delivery.accept', $delivery->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full hover:bg-green-200 transition-colors duration-200"
                                onclick="return confirm('Terima pengiriman #{{ $delivery->tracking_number }} untuk diproses?')">
                            <i class="fas fa-check mr-1"></i>
                            Terima
                        </button>
                    </form>
                    @endif

                    @if(in_array($delivery->status, ['assigned', 'picked_up', 'on_way']))
                    <button type="button"
                            class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-700 text-xs rounded-full hover:bg-orange-200 transition-colors duration-200"
                            onclick="openStatusModal('{{ $delivery->id }}', '{{ $delivery->status }}', '{{ $delivery->tracking_number }}')">
                        <i class="fas fa-edit mr-1"></i>
                        Update
                    </button>
                    @endif

                    @if($delivery->status == 'delivered')
                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full">
                        <i class="fas fa-check-circle mr-1"></i>
                        Selesai
                    </span>
                    @endif

                    @if($delivery->status == 'failed')
                    <button type="button"
                            class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 text-xs rounded-full hover:bg-red-200 transition-colors duration-200"
                            onclick="if(confirm('Coba kirim ulang pengiriman #{{ $delivery->tracking_number }}?')) openStatusModal('{{ $delivery->id }}', 'pending', '{{ $delivery->tracking_number }}')">
                        <i class="fas fa-redo mr-1"></i>
                        Coba Lagi
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-barcode mr-2"></i>Tracking & Order
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-user mr-2"></i>Customer Info
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-info-circle mr-2"></i>Status & Progress
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-calendar mr-2"></i>Timeline
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <i class="fas fa-cogs mr-2"></i>Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($deliveries as $delivery)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div class="space-y-2">
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $delivery->tracking_number }}</div>
                                    <div class="text-sm text-gray-600">Order #{{ $delivery->order->order_number }}</div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="text-sm">
                                        <span class="text-gray-500">Total:</span>
                                        <span class="font-semibold text-green-600">Rp {{ number_format($delivery->order->total_price, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="text-sm">
                                        <span class="text-gray-500">Items:</span>
                                        <span class="font-medium">{{ $delivery->order->orderDetails->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <div class="flex items-center">
                                    <i class="fas fa-user text-blue-500 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-900">{{ $delivery->order->user->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-500 mr-2"></i>
                                    <span class="text-sm text-gray-600">{{ $delivery->order->user->phone }}</span>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-2 mt-1"></i>
                                    <span class="text-sm text-gray-600">{{ Str::limit($delivery->order->delivery_address, 50) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-2">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'assigned' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'picked_up' => 'bg-green-100 text-green-800 border-green-200',
                                        'on_way' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        'delivered' => 'bg-green-100 text-green-800 border-green-200',
                                        'failed' => 'bg-red-100 text-red-800 border-red-200'
                                    ];
                                    $statusIcons = [
                                        'pending' => 'fas fa-clock',
                                        'assigned' => 'fas fa-user-check',
                                        'picked_up' => 'fas fa-box',
                                        'on_way' => 'fas fa-truck',
                                        'delivered' => 'fas fa-check-circle',
                                        'failed' => 'fas fa-times-circle'
                                    ];
                                @endphp
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full border {{ $statusColors[$delivery->status] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                                        <i class="{{ $statusIcons[$delivery->status] ?? 'fas fa-info-circle' }} mr-1"></i>
                                        {{ ucwords(str_replace('_', ' ', $delivery->status)) }}
                                    </span>
                                </div>

                                <!-- Progress Bar -->
                                @php
                                    $progressSteps = ['pending', 'assigned', 'picked_up', 'on_way', 'delivered'];
                                    $currentStep = array_search($delivery->status, $progressSteps);
                                    $progressPercentage = $currentStep !== false ? (($currentStep + 1) / count($progressSteps)) * 100 : 0;
                                @endphp
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                         style="width: {{ $progressPercentage }}%"></div>
                                </div>
                                <div class="text-xs text-gray-500">
                                    Progress: {{ $progressPercentage }}% complete
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <div class="text-sm">
                                    <span class="text-gray-500">Created:</span>
                                    <span class="font-medium">{{ $delivery->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="text-sm">
                                    <span class="text-gray-500">Updated:</span>
                                    <span class="font-medium">{{ $delivery->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                                @if($delivery->notes)
                                <div class="text-sm">
                                    <span class="text-gray-500">Notes:</span>
                                    <span class="text-gray-600 italic">{{ Str::limit($delivery->notes, 30) }}</span>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col space-y-2">
                                <!-- Tombol Detail -->
                                <a href="{{ route('admin.delivery.detail', $delivery->id) }}"
                                   class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 text-xs rounded-md hover:bg-blue-200 transition-colors duration-200"
                                   title="Lihat detail lengkap pengiriman #{{ $delivery->tracking_number }}">
                                    <i class="fas fa-eye mr-2"></i>
                                    Detail
                                </a>

                                <!-- Tombol Terima Pengiriman (untuk status pending) -->
                                @if($delivery->status == 'pending')
                                <form action="{{ route('admin.delivery.accept', $delivery->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="w-full inline-flex items-center px-3 py-2 bg-green-100 text-green-700 text-xs rounded-md hover:bg-green-200 transition-colors duration-200"
                                            title="Terima dan mulai proses pengiriman"
                                            onclick="return confirm('Terima pengiriman #{{ $delivery->tracking_number }} untuk diproses?')">
                                        <i class="fas fa-check mr-2"></i>
                                        Terima
                                    </button>
                                </form>
                                @endif

                                <!-- Tombol Update Status (untuk status yang bisa diupdate) -->
                                @if(in_array($delivery->status, ['assigned', 'picked_up', 'on_way']))
                                <button type="button"
                                        class="w-full inline-flex items-center px-3 py-2 bg-orange-100 text-orange-700 text-xs rounded-md hover:bg-orange-200 transition-colors duration-200"
                                        title="Update status pengiriman #{{ $delivery->tracking_number }}"
                                        onclick="openStatusModal('{{ $delivery->id }}', '{{ $delivery->status }}', '{{ $delivery->tracking_number }}')">
                                    <i class="fas fa-edit mr-2"></i>
                                    Update Status
                                </button>
                                @endif

                                <!-- Status Selesai (untuk status delivered) -->
                                @if($delivery->status == 'delivered')
                                <span class="inline-flex items-center px-3 py-2 bg-green-100 text-green-700 text-xs rounded-md">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Selesai
                                </span>
                                @endif

                                <!-- Tombol Retry (untuk status failed) -->
                                @if($delivery->status == 'failed')
                                <button type="button"
                                        class="w-full inline-flex items-center px-3 py-2 bg-red-100 text-red-700 text-xs rounded-md hover:bg-red-200 transition-colors duration-200"
                                        title="Coba kirim ulang"
                                        onclick="if(confirm('Coba kirim ulang pengiriman #{{ $delivery->tracking_number }}?')) openStatusModal('{{ $delivery->id }}', 'pending', '{{ $delivery->tracking_number }}')">
                                    <i class="fas fa-redo mr-2"></i>
                                    Coba Lagi
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-6 border-t border-gray-200 bg-gray-50">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <div>
                        <i class="fas fa-info-circle mr-1"></i>
                        Menampilkan {{ $deliveries->firstItem() ?? 0 }} - {{ $deliveries->lastItem() ?? 0 }} dari {{ $deliveries->total() }} pengiriman
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-clock mr-1"></i>
                        Halaman {{ $deliveries->currentPage() }} dari {{ $deliveries->lastPage() }}
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="text-sm text-gray-500 hidden md:block">
                        <i class="fas fa-cog mr-1"></i>
                        Per halaman: {{ $deliveries->perPage() }} item
                    </div>
                    <div>
                        {{ $deliveries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Status -->
<div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50 transition-all duration-200">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-6 md:p-8 w-full max-w-lg mx-auto transition-all duration-200 shadow-xl">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Update Status Pengiriman</h3>
                    <p class="text-sm text-gray-600 mt-1">Perbarui status pengiriman dan tambahkan catatan</p>
                </div>
                <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <form id="statusForm" method="POST">
                @csrf
                <div class="space-y-6">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-barcode mr-2"></i>Tracking Number
                        </label>
                        <p id="trackingNumber" class="text-lg font-mono text-blue-800 font-semibold"></p>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-3">
                            <i class="fas fa-flag mr-2"></i>Status Baru
                        </label>
                        <select name="status" id="status" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" required>
                            <option value="assigned">📋 Assigned (Diterima Admin)</option>
                            <option value="picked_up">📦 Picked Up (Barang Diambil)</option>
                            <option value="on_way">🚚 On The Way (Dalam Perjalanan)</option>
                            <option value="delivered">✅ Delivered (Terkirim)</option>
                            <option value="failed">❌ Failed (Gagal)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-2">Pilih status yang sesuai dengan kondisi pengiriman saat ini</p>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-3">
                            <i class="fas fa-sticky-note mr-2"></i>Catatan (Opsional)
                        </label>
                        <textarea name="notes" id="notes" rows="4"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                                  placeholder="Tambahkan catatan pengiriman... (contoh: Barang diambil dari gudang, estimasi sampai 2 jam, atau informasi tambahan untuk customer)"></textarea>
                        <p class="text-xs text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Catatan akan ditampilkan kepada customer dan disimpan dalam riwayat pengiriman
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeStatusModal()"
                            class="px-6 py-3 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openStatusModal(deliveryId, currentStatus, trackingNumber) {
    // Set tracking number
    document.getElementById('trackingNumber').textContent = trackingNumber;

    // Set form action
    document.getElementById('statusForm').action = `/admin/deliveries/${deliveryId}/status`;

    // Set current status in dropdown
    const statusSelect = document.getElementById('status');
    statusSelect.value = currentStatus;

    // Show modal with enhanced animation
    const modal = document.getElementById('statusModal');
    modal.classList.remove('hidden');
    modal.style.opacity = '0';
    modal.style.transform = 'scale(0.95) translateY(-10px)';

    setTimeout(() => {
        modal.style.opacity = '1';
        modal.style.transform = 'scale(1) translateY(0)';
    }, 10);

    // Focus on status select with delay
    setTimeout(() => {
        statusSelect.focus();
        statusSelect.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, 300);

    // Add keyboard shortcuts
    document.addEventListener('keydown', handleModalKeydown);
}

function closeStatusModal() {
    const modal = document.getElementById('statusModal');

    // Enhanced closing animation
    modal.style.opacity = '0';
    modal.style.transform = 'scale(0.95) translateY(-10px)';

    setTimeout(() => {
        modal.classList.add('hidden');
        // Reset form
        document.getElementById('statusForm').reset();
        // Remove keyboard event listener
        document.removeEventListener('keydown', handleModalKeydown);
    }, 200);
}

function handleModalKeydown(e) {
    if (e.key === 'Escape') {
        closeStatusModal();
    }

    // Submit form with Ctrl+Enter
    if (e.ctrlKey && e.key === 'Enter') {
        const submitBtn = document.querySelector('#statusForm button[type="submit"]');
        if (submitBtn && !submitBtn.disabled) {
            submitBtn.click();
        }
    }
}

// Close modal when clicking outside
document.getElementById('statusModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStatusModal();
    }
});

// Enhanced form submission handling
document.getElementById('statusForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    const statusSelect = document.getElementById('status');
    const notesField = document.getElementById('notes');

    // Enhanced validation
    if (!statusSelect.value) {
        e.preventDefault();
        showNotification('Pilih status pengiriman terlebih dahulu', 'error');
        statusSelect.focus();
        return;
    }

    // Show enhanced loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui Status...';
    submitBtn.disabled = true;
    submitBtn.classList.add('opacity-75');

    // Re-enable after a delay (in case of error)
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-75');
    }, 8000);
});

// Enhanced notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' :
                   type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    const icon = type === 'success' ? 'check-circle' :
                type === 'error' ? 'exclamation-circle' : 'info-circle';

    notification.className = `fixed top-4 right-4 px-6 py-4 rounded-lg text-white z-50 transition-all duration-300 ${bgColor} max-w-md shadow-lg`;
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${icon} mr-3 text-lg"></i>
            <div class="flex-1">
                <p class="font-medium">${message}</p>
                <p class="text-xs opacity-90 mt-1">${type === 'success' ? 'Status berhasil diperbarui' : type === 'error' ? 'Terjadi kesalahan' : 'Informasi'}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-3 text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 4 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }
    }, 4000);
}

// Add success message handling with enhanced display
if (window.location.search.includes('success')) {
    const successMessage = new URLSearchParams(window.location.search).get('message');
    if (successMessage) {
        setTimeout(() => {
            showNotification(successMessage, 'success');
        }, 500);
    }
}

// Add table row hover effects for desktop
document.addEventListener('DOMContentLoaded', function() {
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f9fafb';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });

    // Add keyboard navigation for table
    let currentRowIndex = -1;
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            e.preventDefault();
            const rows = Array.from(document.querySelectorAll('tbody tr'));
            if (rows.length === 0) return;

            if (e.key === 'ArrowDown') {
                currentRowIndex = Math.min(currentRowIndex + 1, rows.length - 1);
            } else {
                currentRowIndex = Math.max(currentRowIndex - 1, 0);
            }

            // Remove previous focus
            rows.forEach(row => row.classList.remove('ring-2', 'ring-blue-500'));

            // Add focus to current row
            if (currentRowIndex >= 0) {
                rows[currentRowIndex].classList.add('ring-2', 'ring-blue-500');
                rows[currentRowIndex].scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
});
</script>
@endsection
