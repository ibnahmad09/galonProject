@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Buat Promosi</h1>

<form action="{{ route('promotions.store') }}" method="POST">
    @csrf
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-2">Kode Promosi</label>
                <input type="text" name="code" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block mb-2">Persentase Diskon</label>
                <input type="number" name="discount_percent" class="w-full p-2 border rounded" required>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block mb-2">Tanggal Berakhir</label>
                <input type="date" name="end_date" class="w-full p-2 border rounded" required>
            </div>
        </div>
        <div class="mt-4">
            <label class="block mb-2">Pilih Produk</label>
            <select name="product_id" class="w-full p-2 border rounded" required>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Buat Promosi
            </button>
        </div>
    </div>
</form>
@endsection