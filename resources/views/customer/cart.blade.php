@extends('layouts.customer')

@section('content')
@if(count($cartItems) > 0)
<div class="bg-white p-4 md:p-8 rounded-xl shadow mb-8">
    <h2 class="text-xl md:text-2xl font-extrabold mb-4 md:mb-6 text-blue-700">Keranjang Belanja</h2>

    <!-- Notifikasi Auto-save -->
    <div id="saveNotification" class="hidden mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>Keranjang berhasil diperbarui</span>
        </div>
    </div>

    <form action="{{ route('cart.update') }}" method="POST" id="updateCart">
        @csrf
        <div class="space-y-4 md:space-y-6">
            @foreach($products as $product)
            @if(isset($cartItems[$product->id]))
            <div class="flex flex-col md:flex-row md:items-center justify-between p-3 md:p-4 bg-gray-50 rounded-xl shadow-sm mb-2">
                <div class="flex items-center space-x-3 md:space-x-4">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-xl">
                    <div>
                        <h3 class="font-bold text-base md:text-lg">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm md:text-base">Rp {{ number_format($product->price) }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3 md:space-x-4 mt-3 md:mt-0">
                    <div class="relative">
                        <input type="number" name="quantities[{{ $product->id }}]" value="{{ $cartItems[$product->id]['quantity'] }}" class="quantity-input w-12 md:w-16 border p-2 text-center rounded text-sm md:text-base" data-price="{{ $product->price }}" data-target="total-{{ $product->id }}" data-product-id="{{ $product->id }}" min="1">
                        <!-- Loading indicator -->
                        <div id="loading-{{ $product->id }}" class="hidden absolute -top-1 -right-1 w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                    </div>
                    <div>
                        <p class="font-bold text-sm md:text-base">Total: Rp <span id="total-{{ $product->id }}">{{ number_format($product->price * $cartItems[$product->id]['quantity']) }}</span></p>
                    </div>
                    <a href="{{ route('cart.remove', $product->id) }}" class="text-red-600 hover:text-red-800 font-semibold text-sm md:text-base">Hapus</a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <div class="mt-6 md:mt-8 flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4">
            <a href="{{ route('customer.dashboard') }}" class="text-blue-600 hover:underline text-sm md:text-base">Lanjut Belanja</a>
            <a href="{{ route('customer.checkout') }}" class="bg-green-600 text-white px-4 md:px-6 py-2 rounded hover:bg-green-700 transition font-semibold text-sm md:text-base">Checkout</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const formatRupiah = (angka) => {
        return new Intl.NumberFormat('id-ID').format(angka);
    };

    // Fungsi untuk menampilkan notifikasi
    function showNotification(message, type = 'success') {
        const notification = document.getElementById('saveNotification');
        const icon = notification.querySelector('svg');
        const text = notification.querySelector('span');

        // Update warna dan ikon berdasarkan tipe
        if (type === 'success') {
            notification.className = 'mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg';
            icon.innerHTML = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>';
        } else {
            notification.className = 'mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg';
            icon.innerHTML = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-4.707a1 1 0 00-1.414-1.414L10 12.586l-1.293-1.293a1 1 0 00-1.414 1.414L8.586 14l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l1.293 1.293a1 1 0 001.414-1.414L11.414 14l1.293-1.293z" clip-rule="evenodd"></path>';
        }

        text.textContent = message;
        notification.classList.remove('hidden');

        // Sembunyikan notifikasi setelah 3 detik
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 3000);
    }

    // Fungsi untuk menampilkan/menyembunyikan loading indicator
    function toggleLoading(productId, show) {
        const loading = document.getElementById(`loading-${productId}`);
        if (loading) {
            if (show) {
                loading.classList.remove('hidden');
            } else {
                loading.classList.add('hidden');
            }
        }
    }

    // Fungsi untuk update total harga
    function updateTotal(input) {
        const price = parseInt(input.dataset.price);
        const quantity = parseInt(input.value) || 0;
        const total = price * quantity;
        const targetId = input.dataset.target;
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            targetElement.textContent = formatRupiah(total);
        }
    }

    // Fungsi untuk auto-save ke server
    function autoSaveCart(productId, quantity) {
        toggleLoading(productId, true);

        fetch('{{ route("cart.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                quantities: {
                    [productId]: quantity
                }
            })
        })
        .then(response => response.json())
        .then(data => {
            toggleLoading(productId, false);
            if (data.success) {
                showNotification('Keranjang berhasil diperbarui', 'success');
            } else {
                showNotification('Gagal memperbarui keranjang', 'error');
            }
        })
        .catch(error => {
            toggleLoading(productId, false);
            console.error('Error updating cart:', error);
            showNotification('Gagal memperbarui keranjang', 'error');
        });
    }

    // Debounce function untuk menghindari terlalu banyak request
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Event listener untuk semua input quantity
    document.querySelectorAll('input[name^="quantities"]').forEach(function(input) {
        const debouncedAutoSave = debounce(function(productId, quantity) {
            autoSaveCart(productId, quantity);
        }, 1000); // Delay 1 detik setelah user berhenti mengetik

        // Update saat input berubah
        input.addEventListener('input', function() {
            updateTotal(this);

            // Auto-save dengan debounce
            const productId = this.dataset.productId;
            const quantity = parseInt(this.value) || 0;
            debouncedAutoSave(productId, quantity);
        });

        // Update saat focus
        input.addEventListener('focus', function() {
            updateTotal(this);
        });

        // Update saat blur
        input.addEventListener('blur', function() {
            updateTotal(this);

            // Auto-save langsung saat blur
            const productId = this.dataset.productId;
            const quantity = parseInt(this.value) || 0;
            autoSaveCart(productId, quantity);
        });

        // Update saat keyup
        input.addEventListener('keyup', function() {
            updateTotal(this);
        });
    });

    // Tambahan: Update semua total saat halaman dimuat
    document.querySelectorAll('input[name^="quantities"]').forEach(function(input) {
        updateTotal(input);
    });
});
</script>
@else
<div class="text-center py-16">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <p class="mt-4 text-gray-500">Keranjang anda kosong</p>
</div>
@endif
@endsection
