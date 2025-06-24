@extends('layouts.app')

@section('content')
<div class="w-full max-w-md p-8 bg-white/80 rounded-2xl shadow-xl backdrop-blur-md">
    <div class="flex flex-col items-center mb-6">
        <img src="https://cdn-icons-png.flaticon.com/512/2933/2933884.png" alt="Galon Air" class="w-16 h-16 mb-2">
        <h2 class="text-2xl font-bold text-blue-700 mb-1">Masuk ke Akun</h2>
        <p class="text-blue-500 text-sm">Selamat datang kembali di Galon Rebus!</p>
    </div>
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="block text-blue-800 font-semibold mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password" class="block text-blue-800 font-semibold mb-1">Password</label>
            <input id="password" type="password" name="password" required class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <label class="flex items-center text-blue-700 text-sm">
                <input type="checkbox" name="remember" class="mr-2 accent-blue-600" {{ old('remember') ? 'checked' : '' }}>
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline text-sm">Lupa password?</a>
            @endif
        </div>
        <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow transition">Masuk</button>
    </form>
    <div class="mt-6 text-center text-blue-700 text-sm">
        Belum punya akun? <a href="{{ route('register') }}" class="font-semibold hover:underline">Daftar sekarang</a>
    </div>
</div>
@endsection
