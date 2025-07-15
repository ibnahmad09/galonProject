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
                data-created="{{ $product->created_at }}">
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-40 md:h-48 object-cover rounded-xl mb-4">
                <h3 class="font-bold text-lg text-blue-900 mb-1">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $product->description }}</p>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-blue-700 font-bold text-lg">Rp {{ number_format($product->price) }}</span>
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
