@extends('layouts.app')

@section('content')
<div class="w-full max-w-md p-8 bg-white/80 rounded-2xl shadow-xl backdrop-blur-md">
    <div class="flex flex-col items-center mb-6">
        <img src="https://cdn-icons-png.flaticon.com/512/2933/2933884.png" alt="Galon Air" class="w-16 h-16 mb-2">
        <h2 class="text-2xl font-bold text-blue-700 mb-1">Verifikasi Email</h2>
        <p class="text-blue-500 text-sm text-center">Sebelum melanjutkan, silakan cek email kamu untuk link verifikasi.<br>Jika belum menerima email, klik tombol di bawah.</p>
    </div>
    @if (session('resent'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded shadow text-center">
            Link verifikasi baru telah dikirim ke email kamu.
        </div>
    @endif
    <form method="POST" action="{{ route('verification.resend') }}" class="flex flex-col items-center gap-3">
        @csrf
        <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow transition">Kirim Ulang Email Verifikasi</button>
    </form>
</div>
@endsection
