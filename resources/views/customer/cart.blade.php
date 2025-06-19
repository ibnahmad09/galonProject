@extends('layouts.customer')

@section('content')
@if(count($cartItems) > 0)
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Keranjang Belanja</h2>
    <div class="space-y-4">
        @foreach($products as $product)
        @if(isset($cartItems[$product->id]))
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/'.$product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-20 h-20 object-cover rounded">
                <div>
                    <h3 class="font-bold">{{ $product->name }}</h3>
                    <p>Rp {{ number_format($product->price) }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <form action="{{ route('cart.update') }}" method="POST">
                    @csrf
                    <input type="number" name="quantities[{{ $product->id }}]" 
                           value="{{ $cartItems[$product->id]['quantity'] }}" 
                           class="w-16 border p-2 text-center">
                </div>
                <div>
                    <p class="font-bold">
                        Total: Rp {{ number_format($product->price * $cartItems[$product->id]['quantity']) }}
                    </p>
                </div>
                <a href="{{ route('cart.remove', $product->id) }}" 
                   class="text-red-600 hover:text-red-800">
                    Hapus
                </a>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    
    <div class="mt-6 flex justify-between items-center">
        <a href="{{ route('customer.dashboard') }}" 
           class="text-blue-600 hover:text-blue-800">Lanjut Belanja</a>
        <div>
            <button type="submit" form="updateCart" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-4">
                Update Keranjang
            </button>
            <a href="{{ route('customer.checkout') }}" 
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Checkout
            </a>
        </div>
    </div>
</div>
@else
<div class="text-center py-16">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <p class="mt-4 text-gray-500">Keranjang anda kosong</p>
</div>
@endif
@endsection