@extends('layouts.app')

@section('content')
<div class="w-full max-w-md p-8 bg-white/80 rounded-2xl shadow-xl backdrop-blur-md">
    <div class="flex flex-col items-center mb-6">
        <img src="https://cdn-icons-png.flaticon.com/512/2933/2933884.png" alt="Galon Air" class="w-16 h-16 mb-2">
        <h2 class="text-2xl font-bold text-blue-700 mb-1">Lupa Password?</h2>
        <p class="text-blue-500 text-sm text-center">Masukkan email kamu untuk mendapatkan link reset password.</p>
    </div>
    @if (session('status'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded shadow text-center">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="block text-blue-800 font-semibold mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow transition">Kirim Link Reset</button>
    </form>
    <div class="mt-6 text-center text-blue-700 text-sm">
        <a href="{{ route('login') }}" class="font-semibold hover:underline">Kembali ke Login</a>
    </div>
</div>
@endsection
