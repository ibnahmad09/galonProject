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
        $referrals = \App\Models\User::where('referred_by', $user->referral_code)->get();
        $referralCount = $referrals->count();
        return view('customer.dashboard', compact('user', 'orders', 'products', 'promotions', 'news', 'referrals', 'referralCount'));
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
        $orders = Order::with(['details.product', 'delivery'])->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
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

    public function profile()
    {
        $user = auth()->user();
        return view('customer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Tambahkan validasi lain sesuai kebutuhan
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        // Tambahkan field lain jika ada
        $user->save();
        return redirect()->route('customer.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
