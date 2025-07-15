@extends('layouts.customer')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Diskon Tersedia</h2>

        @if($availableDiscounts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($availableDiscounts as $discount)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-green-800">Diskon Referral</h3>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                Tersedia
                            </span>
                        </div>

                        <div class="mb-4">
                            <p class="text-3xl font-bold text-green-600">
                                Rp {{ number_format($discount->discount_amount, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                Diterima pada {{ $discount->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <div class="flex space-x-2">
                            <button onclick="useDiscount({{ $discount->id }})"
                                    class="flex-1 bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition">
                                Gunakan Diskon
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-400 mb-4">
                    <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada diskon tersedia</h3>
                <p class="text-gray-500">Bagikan kode referral Anda untuk mendapatkan diskon</p>
                <a href="{{ route('customer.referral.index') }}"
                   class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-600 transition">
                    Lihat Program Referral
                </a>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('customer.referral.index') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Kembali ke Program Referral
            </a>
        </div>
    </div>
</div>

<script>
function useDiscount(discountId) {
    if (confirm('Apakah Anda yakin ingin menggunakan diskon ini? Diskon akan siap digunakan pada checkout berikutnya.')) {
        fetch('{{ route("customer.referral.use-discount") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                referral_use_id: discountId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Diskon Rp ${data.data.discount_amount.toLocaleString('id-ID')} siap digunakan! Silakan lanjutkan ke checkout.`);
                window.location.href = '{{ route("customer.checkout") }}';
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan saat menggunakan diskon');
        });
    }
}
</script>
@endsection
