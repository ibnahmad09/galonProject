@extends('layouts.customer')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white py-10 min-h-screen">
    <div class="container mx-auto">
        <h1 class="text-2xl md:text-3xl font-bold text-blue-900 mb-8 text-center">Produk Kami</h1>

        <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
            <div class="product-card bg-white border border-blue-100 rounded-2xl shadow-sm hover:shadow-xl transition-all flex flex-col px-6 py-6"
                data-name="{{ strtolower($product->name) }}"
                data-category="{{ strtolower($product->category) }}"
                data-price="{{ $product->price }}"
                data-rating="{{ $product->rating ?? 0 }}"
                data-created="{{ $product->created_at }}">
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-40 md:h-48 object-cover rounded-xl mb-4">
                <h3 class="font-bold text-lg text-blue-900 mb-1">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $product->description }}</p>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-blue-700 font-bold text-lg">Rp {{ number_format($product->price) }}</span>
                    <span class="ml-auto flex items-center gap-1 text-yellow-500 text-sm font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.175c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.38-2.455a1 1 0 00-1.175 0l-3.38 2.455c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.05 9.394c-.783-.57-.38-1.81.588-1.81h4.175a1 1 0 00.95-.69l1.286-3.967z"/></svg>
                        {{ number_format($product->rating ?? 0, 1) }}
                    </span>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs text-gray-500">Stok: {{ $product->stock }}</span>
                </div>
                <button onclick="addToCart({{ $product->id }})" class="bg-blue-900 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-800 transition w-full">Tambah ke Keranjang</button>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
// Pencarian, filter, dan sorting produk
const productsGrid = document.getElementById('productsGrid');
const productCards = Array.from(document.querySelectorAll('.product-card'));

function filterProducts() {
    const search = searchInput.value.toLowerCase();
    const category = categoryFilter.value.toLowerCase();
    const sort = sortFilter.value;
    let filtered = productCards.filter(card => {
        const name = card.dataset.name;
        const cat = card.dataset.category;
        return (
            (!search || name.includes(search)) &&
            (!category || cat === category)
        );
    });
    // Sorting
    if (sort === 'price_asc') filtered.sort((a, b) => a.dataset.price - b.dataset.price);
    if (sort === 'price_desc') filtered.sort((a, b) => b.dataset.price - a.dataset.price);
    if (sort === 'rating_desc') filtered.sort((a, b) => b.dataset.rating - a.dataset.rating);
    if (sort === 'latest') filtered.sort((a, b) => new Date(b.dataset.created) - new Date(a.dataset.created));
    // Render
    productsGrid.innerHTML = '';
    filtered.forEach(card => productsGrid.appendChild(card));
}
searchInput.addEventListener('input', filterProducts);
categoryFilter.addEventListener('change', filterProducts);
sortFilter.addEventListener('change', filterProducts);

function addToCart(productId) {
    fetch('{{ route("cart.add", "") }}/' + productId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (response.headers.get('content-type')?.includes('application/json')) {
            return response.json();
        } else {
            throw new Error('Bukan response JSON');
        }
    })
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Gagal menambah ke keranjang. Silakan coba lagi.');
    });
}
</script>
@endsection