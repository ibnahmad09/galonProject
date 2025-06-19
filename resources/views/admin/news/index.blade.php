@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Daftar Berita/Informasi</h1>
    <a href="{{ route('admin.news.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Berita</a>
</div>
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
@endif
<table class="w-full bg-white rounded shadow">
    <thead>
        <tr>
            <th class="p-3 text-left">Judul</th>
            <th class="p-3 text-left">Tanggal Publikasi</th>
            <th class="p-3 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($news as $item)
        <tr class="border-b">
            <td class="p-3">{{ $item->title }}</td>
            <td class="p-3">{{ $item->published_at ? date('d M Y', strtotime($item->published_at)) : '-' }}</td>
            <td class="p-3 flex gap-2">
                <a href="{{ route('admin.news.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus berita?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">{{ $news->links() }}</div>
@endsection
