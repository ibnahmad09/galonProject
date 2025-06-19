@extends('layouts.customer')

@section('content')
<!-- Hero Section -->
<div class="bg-blue-500 text-white p-6 rounded-lg mb-6">
    <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p class="mt-2">Pesan air rebus berkualitas dengan mudah</p>
</div>

<!-- Promo Section -->
@if($promotions->count() > 0)
<div class="mb-6">
    <h2 class="text-xl font-bold mb-4">Promo Hari Ini</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($promotions as $promo)
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">{{ $promo->product->name }}</h3>
            <p class="text-red-500">Diskon {{ $promo->discount_percent }}%</p>
            <p class="text-sm text-gray-500">Berlaku sampai {{ $promo->end_date->format('d M Y') }}</p>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Produk Terlaris -->
<div>
    <h2 class="text-xl font-bold mb-4">Produk Kami</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($products as $product)
        <div class="bg-white p-4 rounded-lg shadow relative">
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" 
                 class="w-full h-48 object-cover rounded mb-4">
            <h3 class="font-bold">{{ $product->name }}</h3>
            <p class="text-gray-500">Rp {{ number_format($product->price) }}</p>
            <div class="mt-4 flex justify-between">
                <button onclick="addToCart({{ $product->id }})" 
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Tambah ke Keranjang
                </button>
                <a href="{{ route('customer.product.detail', $product->id) }}" 
                   class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
function addToCart(productId) {
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
@endsection