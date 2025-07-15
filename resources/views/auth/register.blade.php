@extends('layouts.app')

@section('content')
<div class="w-full max-w-lg p-8 bg-white/80 rounded-2xl shadow-xl backdrop-blur-md">
    <div class="flex flex-col items-center mb-6">
        <img src="https://cdn-icons-png.flaticon.com/512/2933/2933884.png" alt="Galon Air" class="w-16 h-16 mb-2">
        <h2 class="text-2xl font-bold text-blue-700 mb-1">Daftar Akun Baru</h2>
        <p class="text-blue-500 text-sm">Gabung dan nikmati kemudahan pesan galon rebus!</p>
    </div>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf
        <div>
            <label for="name" class="block text-blue-800 font-semibold mb-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="email" class="block text-blue-800 font-semibold mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
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
        <div>
            <label for="password-confirm" class="block text-blue-800 font-semibold mb-1">Konfirmasi Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>
        <div>
            <label for="phone" class="block text-blue-800 font-semibold mb-1">Nomor Telepon</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            @error('phone')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="address" class="block text-blue-800 font-semibold mb-1">Alamat Lengkap</label>
            <textarea id="address" name="address" required class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" rows="3">{{ old('address') }}</textarea>
            @error('address')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="referral_code" class="block text-blue-800 font-semibold mb-1">Kode Referral (opsional)</label>
            <input id="referral_code" type="text" name="referral_code" value="{{ old('referral_code', $referralCode ?? '') }}" class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan kode referral jika ada">
            @error('referral_code')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
            <p class="text-xs text-blue-600 mt-1">Dapatkan diskon Rp 10.000 untuk order pertama Anda!</p>
        </div>
        <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow transition">Daftar</button>
    </form>
    <div class="mt-6 text-center text-blue-700 text-sm">
        Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold hover:underline">Masuk</a>
    </div>
</div>
@endsection
