@extends('layouts.customer')

@section('content')
<div class="bg-white p-4 md:p-8 rounded-xl shadow mb-8">
    <h2 class="text-xl md:text-2xl font-extrabold mb-4 md:mb-6 text-blue-700">Produk {{ ucfirst($category) }}</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
        @foreach($products as $product)
        <div class="bg-white p-3 md:p-4 rounded-xl shadow hover:shadow-lg transition flex flex-col">
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-36 md:h-44 object-cover rounded-t-xl mb-3 md:mb-4">
            <h3 class="font-bold text-base md:text-lg mb-1">{{ $product->name }}</h3>
            <p class="text-gray-500 mb-2 text-sm md:text-base">Rp {{ number_format($product->price) }}</p>
            <div class="mt-auto flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                <button onclick="addToCart({{ $product->id }})" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700 transition text-sm md:text-base">Tambah ke Keranjang</button>
                <a href="{{ route('customer.product.detail', $product->id) }}" class="text-blue-600 hover:underline ml-0 md:ml-2 text-sm md:text-base">Lihat Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
