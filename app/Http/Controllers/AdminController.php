<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\StockMutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Dashboard Admin
    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalOrders', 
            'totalProducts', 
            'pendingOrders',
            'recentOrders'
        ));
    }

    // Manajemen Produk
    public function products()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan');
    }

    public function editProduct(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete('public/'.$product->image);
            }
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui');
    }

    // Manajemen Pesanan
    public function orders()
    {
        $orders = Order::with('user', 'details.product')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan diperbarui');
    }

    // Manajemen Promosi
    public function promotions()
    {
        $promotions = Promotion::with('product')->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    // Manajemen Stok
    public function stockMutations()
    {
        $mutations = StockMutation::with('product')->orderBy('created_at', 'desc')->get();
        return view('admin.stock.index', compact('mutations'));
    }

    // Di AdminController.php
    public function assignCourier(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $delivery = $order->delivery;

        $delivery->courier_id = $request->courier_id;
        $delivery->save();

        return redirect()->back()->with('success', 'Kurir berhasil ditugaskan');
    }

    public function destroyProduct(Product $product)
    {
        // Hapus gambar jika ada
        if ($product->image) {
            Storage::delete('public/'.$product->image);
        }
        
        $product->delete();
        
        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus');
    }
}