@extends('layouts.customer')

@section('content')
<div class="bg-white p-4 md:p-8 rounded-xl shadow mb-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
        <!-- Gambar Produk -->
        <div>
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-64 md:h-96 object-cover rounded-xl">
        </div>
        <!-- Detail Produk -->
        <div class="flex flex-col justify-between mt-4 md:mt-0">
            <div>
                <h1 class="text-xl md:text-3xl font-extrabold mb-2 md:mb-4 text-blue-700">{{ $product->name }}</h1>
                <p class="text-gray-500 mb-2 md:mb-4 text-sm md:text-base">{{ $product->description }}</p>
                @if($promotion)
                <div class="mb-2 md:mb-4">
                    <p class="text-red-500 font-bold">Diskon {{ $promotion->discount_percent }}%</p>
                    <p class="text-gray-400 line-through">Rp {{ number_format($product->price) }}</p>
                    <p class="text-lg md:text-2xl text-green-600 font-bold">Rp {{ number_format($product->price * (100 - $promotion->discount_percent)/100) }}</p>
                </div>
                @else
                <p class="text-lg md:text-2xl text-blue-600 font-bold mb-2 md:mb-4">Rp {{ number_format($product->price) }}</p>
                @endif
            </div>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4 md:mt-6">
                @csrf
                <div class="flex items-center mb-4">
                    <button type="button" onclick="this.parentNode.querySelector('input').stepDown()" class="bg-gray-200 px-3 py-1 rounded-l">-</button>
                    <input type="number" name="quantity" value="1" min="1" class="w-16 md:w-20 text-center border">
                    <button type="button" onclick="this.parentNode.querySelector('input').stepUp()" class="bg-gray-200 px-3 py-1 rounded-r">+</button>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 md:px-6 py-2 rounded hover:bg-blue-700 transition font-semibold text-sm md:text-base">Tambah ke Keranjang</button>
            </form>
        </div>
    </div>
</div>
@endsection
