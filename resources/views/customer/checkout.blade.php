@extends('layouts.customer')

@section('content')
<div class="bg-white p-4 md:p-8 rounded-xl shadow mb-8">
    <h2 class="text-xl md:text-2xl font-extrabold mb-4 md:mb-6 text-blue-700">Checkout</h2>
    <form action="{{ route('order.place') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
            <!-- Detail Pengiriman -->
            <div>
                <h3 class="text-base md:text-lg font-bold mb-2 md:mb-4 text-blue-700">Alamat Pengiriman</h3>
                <div class="mb-3 md:mb-4">
                    <label class="block mb-1 md:mb-2 text-sm md:text-base">Alamat Lengkap</label>
                    <textarea name="delivery_address" class="w-full p-2 border rounded text-sm md:text-base" required>{{ Auth::user()->address }}</textarea>
                </div>
                <div class="mb-3 md:mb-4">
                    <label class="block mb-1 md:mb-2 text-sm md:text-base">Nomor Telepon</label>
                    <input type="text" name="phone" class="w-full p-2 border rounded text-sm md:text-base" value="{{ Auth::user()->phone }}" required>
                </div>
            </div>
            <!-- Ringkasan Pesanan -->
            <div>
                <h3 class="text-base md:text-lg font-bold mb-2 md:mb-4 text-blue-700">Ringkasan Pesanan</h3>
                <div class="space-y-2 md:space-y-4">
                    @foreach($cartItems as $itemId => $item)
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm md:text-base">{{ $item['name'] }}</p>
                            <p class="text-gray-500 text-xs md:text-base">Rp {{ number_format($item['price']) }}</p>
                        </div>
                        <p class="text-sm md:text-base">x{{ $item['quantity'] }}</p>
                    </div>
                    @endforeach
                </div>
                <hr class="my-3 md:my-4">
                <div class="flex justify-between font-bold text-sm md:text-base">
                    <p>Total</p>
                    <p>Rp {{ number_format(array_sum(array_map(function($item) {
                        return $item['price'] * $item['quantity'];
                    }, $cartItems))) }}</p>
                </div>
            </div>
        </div>
        <!-- Metode Pembayaran -->
        <div class="mt-6 md:mt-8">
            <h3 class="text-base md:text-lg font-bold mb-2 md:mb-4 text-blue-700">Metode Pembayaran</h3>
            <div class="space-y-2 md:space-y-4">
                <label class="flex items-center text-sm md:text-base">
                    <input type="radio" name="payment_method" value="Cash" class="mr-2" required>
                    Bayar di Tempat (COD)
                </label>
                <label class="flex items-center text-sm md:text-base">
                    <input type="radio" name="payment_method" value="Transfer" class="mr-2">
                    Transfer Bank
                </label>
                <label class="flex items-center text-sm md:text-base">
                    <input type="radio" name="payment_method" value="Midtrans" class="mr-2">
                    Midtrans (Virtual Account, e-Wallet, dll)
                </label>
            </div>
        </div>
        <div class="mt-6 md:mt-8">
            <button type="submit" class="bg-green-600 text-white px-4 md:px-6 py-2 rounded hover:bg-green-700 transition font-semibold text-sm md:text-base">Konfirmasi Pesanan</button>
        </div>
    </form>
</div>
@endsection
