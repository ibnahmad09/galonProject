@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Berita/Informasi</h1>
    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Judul</label>
            <input type="text" name="title" class="w-full border p-2 rounded" value="{{ $news->title }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Isi Berita</label>
            <textarea name="content" rows="6" class="w-full border p-2 rounded" required>{{ $news->content }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Gambar (opsional)</label>
            @if($news->image)
                <img src="{{ asset('storage/'.$news->image) }}" class="mb-2 w-32 rounded">
            @endif
            <input type="file" name="image" class="w-full">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Publikasi (opsional)</label>
            <input type="date" name="published_at" class="w-full border p-2 rounded" value="{{ $news->published_at ? date('Y-m-d', strtotime($news->published_at)) : '' }}">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.news.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
