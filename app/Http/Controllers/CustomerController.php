<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\News;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }

    // Halaman Utama Customer
    public function dashboard()
    {
        $user = auth()->user();
        $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        $products = Product::all();
        $promotions = Promotion::with('product')->where('end_date', '>=', now())->get();
        $news = News::orderBy('published_at', 'desc')->take(3)->get();
        return view('customer.dashboard', compact('user', 'orders', 'products', 'promotions', 'news'));
    }

    // Detail Produk
    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $promotion = Promotion::where('product_id', $id)
            ->where('end_date', '>', now())
            ->first();
        return view('customer.product-detail', compact('product', 'promotion'));
    }

    // Checkout
    public function checkout()
    {
        $cartItems = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cartItems))->get();
        return view('customer.checkout', compact('cartItems', 'products'));
    }

    // Riwayat Pesanan
    public function orderHistory()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('customer.order-history', compact('orders'));
    }

    public function products(Request $request)
    {
        $category = $request->query('category');
        $products = Product::when($category, function ($query, $category) {
            return $query->where('category', $category);
        })->get();

        return view('customer.products', compact('products', 'category'));
    }
}
