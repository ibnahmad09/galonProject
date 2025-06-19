@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-2">Nama Produk</label>
                <input type="text" name="name" class="w-full p-2 border rounded" value="{{ $product->name }}" required>
            </div>
            <div>
                <label class="block mb-2">Harga</label>
                <input type="number" name="price" class="w-full p-2 border rounded" value="{{ $product->price }}" required>
            </div>
        </div>
        <div class="mt-4">
            <label class="block mb-2">Deskripsi</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="3">{{ $product->description }}</textarea>
        </div>
        <div class="mt-4">
            <label class="block mb-2">Gambar</label>
            <input type="file" name="image" class="w-full p-2 border rounded">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="mt-2 w-32">
            @endif
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Produk
            </button>
        </div>
    </div>
</form>
@endsection 