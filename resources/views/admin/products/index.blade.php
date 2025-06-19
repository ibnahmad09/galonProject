@extends('layouts.admin')

@section('content')
<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Daftar Produk</h1>
    <a href="{{ route('admin.products.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Tambah Produk
    </a>
</div>

<!-- Tabel Produk -->
<div class="bg-white p-6 rounded-lg shadow">
    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left pb-4">Nama</th>
                <th class="text-left pb-4">Harga</th>
                <th class="text-left pb-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-4">{{ $product->name }}</td>
                <td>Rp {{ number_format($product->price) }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                       class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection