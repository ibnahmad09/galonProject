@extends('layouts.customer')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Produk {{ ucfirst($category) }}</h2>
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
@endsection