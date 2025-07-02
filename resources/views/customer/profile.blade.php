@extends('layouts.customer')

@section('content')
<div class="flex flex-col md:flex-row justify-center items-start gap-8 mt-8 px-2 md:px-0">
    <!-- Profile Card -->
    <div class="w-full md:max-w-md bg-white/70 backdrop-blur-lg shadow-2xl rounded-2xl p-8 relative border border-blue-100 animate-fadeInUp">
        <div class="flex flex-col items-center mb-6">
            <div class="relative mb-2 group">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=128" alt="Avatar" class="w-28 h-28 rounded-full shadow-lg border-4 border-blue-400 transition-transform duration-700 group-hover:rotate-180" style="box-shadow:0 0 32px 0 #38bdf8, 0 0 0 4px #fff;">
                <span class="absolute bottom-2 right-2 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></span>
            </div>
            <h2 class="text-2xl font-extrabold text-gray-800 tracking-wide mb-1">{{ $user->name }}</h2>
            <p class="text-blue-600 font-semibold text-sm mb-2">Customer</p>
            <div class="flex flex-col items-center gap-1 text-xs text-gray-500">
                <span>Bergabung sejak: <b>{{ $user->created_at->format('d M Y') }}</b></span>
                <span>Email: <b>{{ $user->email }}</b></span>
                @if(isset($orderCount))
                <span>Jumlah Pesanan: <b>{{ $orderCount }}</b></span>
                @endif
            </div>
            @if(session('success'))
                <div class="mt-3 w-full text-center bg-green-100 text-green-700 px-4 py-2 rounded shadow">{{ session('success') }}</div>
            @endif
        </div>
        <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-6 mt-4">
            @csrf
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-1">Nama</label>
                <input type="text" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="off">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" class="form-input w-full rounded-lg border-gray-300 bg-gray-100 cursor-not-allowed" id="email" name="email" value="{{ $user->email }}" readonly>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow transition-all duration-200">Simpan Perubahan</button>
        </form>
    </div>

    <!-- Change Password Card -->
    <div class="w-full md:max-w-md bg-white/70 backdrop-blur-lg shadow-2xl rounded-2xl p-8 border border-blue-100 mt-8 md:mt-0 animate-fadeInUp">
        <h3 class="text-xl font-bold text-blue-700 mb-4 text-center">Ganti Password</h3>
        @if(session('password_success'))
            <div class="mb-3 w-full text-center bg-green-100 text-green-700 px-4 py-2 rounded shadow">{{ session('password_success') }}</div>
        @endif
        @if(session('password_error'))
            <div class="mb-3 w-full text-center bg-red-100 text-red-700 px-4 py-2 rounded shadow">{{ session('password_error') }}</div>
        @endif
        <form action="{{ route('customer.profile.password') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="current_password" class="block text-gray-700 font-semibold mb-1">Password Lama</label>
                <input type="password" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('current_password') border-red-500 @enderror" id="current_password" name="current_password" required autocomplete="current-password">
                @error('current_password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="new_password" class="block text-gray-700 font-semibold mb-1">Password Baru</label>
                <input type="password" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('new_password') border-red-500 @enderror" id="new_password" name="new_password" required autocomplete="new-password">
                @error('new_password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="new_password_confirmation" class="block text-gray-700 font-semibold mb-1">Konfirmasi Password Baru</label>
                <input type="password" class="form-input w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" id="new_password_confirmation" name="new_password_confirmation" required autocomplete="new-password">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow transition-all duration-200">Ganti Password</button>
        </form>
    </div>
</div>
<style>
@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(40px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-fadeInUp {
    animation: fadeInUp 0.7s cubic-bezier(.39,.575,.565,1.000) both;
}
</style>
<script>
// Avatar animasi berputar saat hover
const avatar = document.querySelector('.group img');
if (avatar) {
    avatar.addEventListener('mouseenter', () => {
        avatar.style.transition = 'transform 0.7s';
        avatar.style.transform = 'rotate(180deg)';
    });
    avatar.addEventListener('mouseleave', () => {
        avatar.style.transform = '';
    });
}
</script>
@endsection