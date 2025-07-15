@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Pengaturan Sistem Referral</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.referral-settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="referrer_discount_amount" class="block text-sm font-medium text-gray-700 mb-2">
                        Diskon untuk Pengajak (Rp)
                    </label>
                    <input type="number"
                           step="1000"
                           min="0"
                           name="referrer_discount_amount"
                           id="referrer_discount_amount"
                           value="{{ old('referrer_discount_amount', $settings->referrer_discount_amount ?? 5000) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Nominal diskon yang diberikan kepada customer yang mengajak</p>
                </div>

                <div>
                    <label for="referred_discount_amount" class="block text-sm font-medium text-gray-700 mb-2">
                        Diskon untuk yang Diajak (Rp)
                    </label>
                    <input type="number"
                           step="1000"
                           min="0"
                           name="referred_discount_amount"
                           id="referred_discount_amount"
                           value="{{ old('referred_discount_amount', $settings->referred_discount_amount ?? 10000) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Nominal diskon yang diberikan kepada customer yang menggunakan kode referral</p>
                </div>



                <div>
                    <label class="flex items-center">
                        <input type="checkbox"
                               name="is_active"
                               value="1"
                               {{ old('is_active', $settings->is_active ?? true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Aktifkan sistem referral</span>
                    </label>
                    <p class="text-sm text-gray-500 mt-1">Centang untuk mengaktifkan sistem referral</p>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    <!-- Statistik Referral -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h3 class="text-xl font-bold mb-4 text-gray-800">Statistik Referral</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-blue-800">Total Customer</h4>
                <p class="text-2xl font-bold text-blue-600">{{ \App\Models\User::where('role', 'customer')->count() }}</p>
            </div>

            <div class="bg-green-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-green-800">Total Referral</h4>
                <p class="text-2xl font-bold text-green-600">{{ \App\Models\User::whereNotNull('referred_by')->count() }}</p>
            </div>

            <div class="bg-purple-50 p-4 rounded-lg">
                <h4 class="text-lg font-semibold text-purple-800">Total Diskon Diberikan</h4>
                <p class="text-2xl font-bold text-purple-600">Rp {{ number_format(\App\Models\ReferralUse::sum('discount_amount'), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
