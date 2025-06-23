@extends('layouts.customer')

@section('content')
<div class="flex justify-center mt-8">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <div class="flex flex-col items-center mb-6">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=128" alt="Avatar" class="w-24 h-24 rounded-full shadow mb-2">
            <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>
            @if(session('success'))
                <div class="mt-2 w-full text-center bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
            @endif
        </div>
        <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-1">Nama</label>
                <input type="text" class="form-input w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" class="form-input w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!-- Tambahkan field lain jika perlu -->
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
