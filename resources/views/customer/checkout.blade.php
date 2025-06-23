@extends('layouts.customer')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Checkout</h2>

    <form action="{{ route('order.place') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Detail Pengiriman -->
            <div>
                <h3 class="text-lg font-bold mb-4">Alamat Pengiriman</h3>
                <div class="mb-4">
                    <label class="block mb-2">Alamat Lengkap</label>
                    <textarea name="delivery_address" class="w-full p-2 border rounded" required>{{ Auth::user()->address }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" class="w-full p-2 border rounded" value="{{ Auth::user()->phone }}" required>
                </div>
            </div>

            <!-- Ringkasan Pesanan -->
            <div>
                <h3 class="text-lg font-bold mb-4">Ringkasan Pesanan</h3>
                <div class="space-y-4">
                    @foreach($cartItems as $itemId => $item)
                    <div class="flex justify-between">
                        <div>
                            <p>{{ $item['name'] }}</p>
                            <p class="text-gray-500">Rp {{ number_format($item['price']) }}</p>
                        </div>
                        <p>x{{ $item['quantity'] }}</p>
                    </div>
                    @endforeach
                </div>
                <hr class="my-4">
                <div class="flex justify-between font-bold">
                    <p>Total</p>
                    <p>Rp {{ number_format(array_sum(array_map(function($item) {
                        return $item['price'] * $item['quantity'];
                    }, $cartItems))) }}</p>
                </div>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mt-6">
            <h3 class="text-lg font-bold mb-4">Metode Pembayaran</h3>
            <div class="space-y-4">
                <label class="flex items-center">
                    <input type="radio" name="payment_method" value="Cash" class="mr-2" required>
                    Bayar di Tempat (COD)
                </label>
                <label class="flex items-center">
                    <input type="radio" name="payment_method" value="Transfer" class="mr-2">
                    Transfer Bank
                </label>
                <label class="flex items-center">
                    <input type="radio" name="payment_method" value="Midtrans" class="mr-2">
                    Midtrans (Virtual Account, e-Wallet, dll)
                </label>
            </div>
        </div>

        <div class="mt-8">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Konfirmasi Pesanan
            </button>
        </div>
    </form>
</div>
@endsection