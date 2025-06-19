@extends('layouts.admin')

@section('content')
<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Promosi</h1>
    <a href="{{ route('promotions.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Buat Promosi
    </a>
</div>

<div class="bg-white p-6 rounded-lg shadow">
    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left pb-4">Kode</th>
                <th class="text-left pb-4">Produk</th>
                <th class="text-left pb-4">Diskon</th>
                <th class="text-left pb-4">Berlaku Sampai</th>
                <th class="text-left pb-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promo)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-4">{{ $promo->code }}</td>
                <td>{{ $promo->product->name }}</td>
                <td>{{ $promo->discount_percent }}%</td>
                <td>{{ $promo->end_date->format('d M Y') }}</td>
                <td>
                    <form action="{{ route('promotions.destroy', $promo->id) }}" method="POST" class="inline">
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