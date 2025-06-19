@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Produk</h1>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-2">Nama Produk</label>
                <input type="text" name="name" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block mb-2">Harga</label>
                <input type="number" name="price" class="w-full p-2 border rounded" required>
            </div>
        </div>
        <div class="mt-4">
            <label class="block mb-2">Deskripsi</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="3"></textarea>
        </div>
        <div class="mt-4">
            <label class="block mb-2">Gambar</label>
            <input type="file" name="image" class="w-full p-2 border rounded">
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Produk
            </button>
        </div>
    </div>
</form>
@endsection