@extends('layouts.customer')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-blue-100">
        <a href="{{ route('customer.about') }}" class="inline-block mb-4 text-blue-600 hover:underline text-sm font-semibold">&larr; Kembali ke Tentang Kami</a>
        <h1 class="text-2xl md:text-3xl font-extrabold text-blue-700 mb-2">{{ $item->title }}</h1>
        <p class="text-xs text-gray-400 mb-6">{{ $item->published_at ? date('d M Y', strtotime($item->published_at)) : '' }}</p>
        <div class="prose max-w-none text-gray-800 mb-4">
            {!! $item->content !!}
        </div>
    </div>
</div>
@endsection
