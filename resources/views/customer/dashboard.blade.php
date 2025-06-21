@extends('layouts.customer')

@section('content')
<!-- Hero Section -->
<div class="bg-blue-500 text-white p-6 rounded-lg mb-6">
    <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p class="mt-2">Pesan air rebus berkualitas dengan mudah</p>
</div>

<!-- Promo Section -->
@if($promotions->count() > 0)
<div class="mb-6">
    <h2 class="text-xl font-bold mb-4">Promo Hari Ini</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($promotions as $promo)
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">{{ $promo->product->name }}</h3>
            <p class="text-red-500">Diskon {{ $promo->discount_percent }}%</p>
            <p class="text-sm text-gray-500">Berlaku sampai {{ $promo->end_date->format('d M Y') }}</p>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Produk Terlaris -->
<div>
    <h2 class="text-xl font-bold mb-4">Produk Kami</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($products as $product)
        <div class="bg-white p-4 rounded-lg shadow relative">
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                 class="w-full h-48 object-cover rounded mb-4">
            <h3 class="font-bold">{{ $product->name }}</h3>
            <p class="text-gray-500">Rp {{ number_format($product->price) }}</p>
            <div class="mt-4 flex justify-between">
                <button onclick="addToCart({{ $product->id }})"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Tambah ke Keranjang
                </button>
                <a href="{{ route('customer.product.detail', $product->id) }}"
                   class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Informasi/Berita Section -->
<div class="mb-6">
    <h2 class="text-xl font-bold mb-4">Informasi & Berita</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($news as $item)
        <div class="bg-white p-4 rounded-lg shadow">
            @if($item->image)
                <img src="{{ asset('storage/'.$item->image) }}" class="mb-2 w-full h-32 object-cover rounded">
            @endif
            <h3 class="text-lg font-bold">{{ $item->title }}</h3>
            <p class="text-sm text-gray-500">{{ Str::limit(strip_tags($item->content), 100) }}</p>
            <p class="text-xs text-gray-400 mt-2">{{ $item->published_at ? date('d M Y', strtotime($item->published_at)) : '' }}</p>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-500">Belum ada berita/informasi.</div>
        @endforelse
    </div>
</div>

<!-- Tracking Status Pesanan -->
<div class="mb-6">
    <h2 class="text-xl font-bold mb-4">Status Pesanan</h2>
    <div class="bg-white p-6 rounded-lg shadow">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left pb-4">No. Pesanan</th>
                    <th class="text-left pb-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @if($orders->count() > 0)
                    @foreach($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4">{{ $order->order_number }}</td>
                        <td>
                            <span class="px-2 py-1 rounded {{
                                $order->status == 'pending' ? 'bg-yellow-200 text-yellow-800' :
                                ($order->status == 'delivered' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')
                            }}">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2" class="py-4 text-center">Tidak ada pesanan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Kategori Produk -->
<div class="mb-6">
    <h2 class="text-xl font-bold mb-4">Kategori Produk</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Air</h3>
            <p class="text-sm text-gray-500">Pesan air rebus berkualitas.</p>
            <a href="{{ route('customer.products', ['category' => 'air']) }}" class="text-blue-600 hover:text-blue-800">Lihat Produk</a>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Galon + Air</h3>
            <p class="text-sm text-gray-500">Pesan galon beserta air rebus.</p>
            <a href="{{ route('customer.products', ['category' => 'galon-air']) }}" class="text-blue-600 hover:text-blue-800">Lihat Produk</a>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Galon Only</h3>
            <p class="text-sm text-gray-500">Pesan galon saja.</p>
            <a href="{{ route('customer.products', ['category' => 'galon-only']) }}" class="text-blue-600 hover:text-blue-800">Lihat Produk</a>
        </div>
    </div>
</div>

<!-- Pemasaran Section -->
<div class="mb-6">
    <h2 class="text-xl font-bold mb-4">Pemasaran</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Promo Spesial</h3>
            <p class="text-sm text-gray-500">Dapatkan diskon spesial untuk pembelian pertama Anda.</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Testimoni Pelanggan</h3>
            <p class="text-sm text-gray-500">Baca pengalaman pelanggan kami yang puas dengan layanan kami.</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Program Referral</h3>
            <p class="text-sm text-gray-500">Dapatkan bonus dengan mengajak teman Anda untuk bergabung.</p>
        </div>
    </div>
</div>

<!-- Referral Section -->
<div class="bg-white p-4 rounded-lg shadow mb-6">
    <h2 class="text-xl font-bold mb-2">Kode Referral Anda</h2>
    <div class="flex items-center gap-2 mb-2">
        <span class="font-mono text-lg bg-gray-100 px-3 py-1 rounded">{{ Auth::user()->referral_code }}</span>
        <button onclick="navigator.clipboard.writeText('{{ Auth::user()->referral_code }}')" class="text-blue-600 hover:underline">Salin</button>
    </div>
    <p class="text-sm text-gray-500 mb-2">Bagikan kode ini ke teman Anda. Jika mereka mendaftar dengan kode ini, Anda akan mendapatkan benefit khusus!</p>
    <div class="mt-4">
        <span class="font-semibold">Jumlah Referral Berhasil: </span>
        <span class="text-blue-700 font-bold">{{ $referralCount }}</span>
    </div>
    @if($referralCount > 0)
    <div class="mt-2">
        <span class="font-semibold">Daftar Referral:</span>
        <ul class="list-disc ml-6 text-sm mt-1">
            @foreach($referrals as $ref)
                <li>{{ $ref->name }} ({{ $ref->email }})</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<script>
function addToCart(productId) {
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
@endsection
