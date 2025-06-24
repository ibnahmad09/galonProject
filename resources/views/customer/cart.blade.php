@extends('layouts.customer')

@section('content')
@if(count($cartItems) > 0)
<div class="bg-white p-4 md:p-8 rounded-xl shadow mb-8">
    <h2 class="text-xl md:text-2xl font-extrabold mb-4 md:mb-6 text-blue-700">Keranjang Belanja</h2>
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
                    <input type="number" name="quantities[{{ $product->id }}]" value="{{ $cartItems[$product->id]['quantity'] }}" class="w-12 md:w-16 border p-2 text-center rounded text-sm md:text-base" data-price="{{ $product->price }}" data-target="total-{{ $product->id }}" min="1">
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
            return angka.toLocaleString('id-ID');
        };
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('input', function() {
                let price = parseInt(this.dataset.price);
                let qty = parseInt(this.value) || 1;
                let total = price * qty;
                let target = document.getElementById(this.dataset.target);
                if(target) {
                    target.textContent = formatRupiah(total);
                }
            });
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
