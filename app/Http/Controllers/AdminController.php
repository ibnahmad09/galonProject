<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\StockMutation;
use App\Models\News;
use App\Models\Delivery;
use App\Models\Notification;
use App\Models\User;
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

        // Statistik pengiriman
        $pendingDeliveries = Delivery::where('status', 'pending')->count();
        $activeDeliveries = Delivery::whereIn('status', ['assigned', 'picked_up', 'on_way'])->count();
        $completedDeliveries = Delivery::where('status', 'delivered')->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'pendingOrders',
            'recentOrders',
            'pendingDeliveries',
            'activeDeliveries',
            'completedDeliveries'
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
        $orders = Order::with(['user', 'details.product', 'delivery.courier'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $couriers = User::where('role', 'courier')->get();

        return view('admin.orders.index', compact('orders', 'couriers'));
    }

    public function orderDetail($id)
    {
        $order = Order::with(['user', 'details.product', 'delivery.courier'])->findOrFail($id);
        $couriers = User::where('role', 'courier')->get();

        return view('admin.orders.detail', compact('order', 'couriers'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        // Jika status berubah menjadi 'processing', kirim notifikasi ke semua kurir
        if ($request->status == 'processing' && $oldStatus != 'processing') {
            $this->notifyCouriersForDelivery($order);
        }

        return redirect()->back()->with('success', 'Status pesanan diperbarui');
    }

    // Assign Courier
    public function assignCourier(Request $request, $orderId)
    {
        $request->validate([
            'courier_id' => 'required|exists:users,id'
        ]);

        $order = Order::findOrFail($orderId);
        $delivery = $order->delivery;
        $oldCourierId = $delivery->courier_id;

        $delivery->courier_id = $request->courier_id;
        $delivery->status = 'assigned';
        $delivery->save();

        // Kirim notifikasi ke kurir yang ditugaskan
        $courier = User::find($request->courier_id);
        Notification::create([
            'user_id' => $request->courier_id,
            'title' => 'Pengiriman Baru Ditugaskan',
            'message' => 'Anda ditugaskan untuk mengirim pesanan #' . $order->order_number . ' ke ' . $order->user->name,
            'type' => 'delivery_assigned'
        ]);

        // Jika ada kurir lama, kirim notifikasi pembatalan
        if ($oldCourierId && $oldCourierId != $request->courier_id) {
            Notification::create([
                'user_id' => $oldCourierId,
                'title' => 'Pengiriman Dibatalkan',
                'message' => 'Pengiriman pesanan #' . $order->order_number . ' telah ditugaskan ke kurir lain',
                'type' => 'delivery_cancelled'
            ]);
        }

        return redirect()->back()->with('success', 'Kurir berhasil ditugaskan');
    }

    // Notifikasi ke semua kurir
    private function notifyCouriersForDelivery($order)
    {
        $couriers = User::where('role', 'courier')->get();

        foreach ($couriers as $courier) {
            Notification::create([
                'user_id' => $courier->id,
                'title' => 'Pengiriman Baru Tersedia',
                'message' => 'Ada pengiriman baru untuk pesanan #' . $order->order_number . ' dari ' . $order->user->name,
                'type' => 'new_delivery_available'
            ]);
        }
    }

    // Manajemen Pengiriman
    public function deliveries()
    {
        $deliveries = Delivery::with(['order.user', 'courier'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.deliveries.index', compact('deliveries'));
    }

    public function deliveryDetail($id)
    {
        $delivery = Delivery::with(['order.user', 'order.details.product', 'courier'])
            ->findOrFail($id);

        return view('admin.deliveries.detail', compact('delivery'));
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

    public function destroyProduct(Product $product)
    {
        // Hapus gambar jika ada
        if ($product->image) {
            Storage::delete('public/'.$product->image);
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus');
    }

    // --- Berita/Informasi ---
    public function newsIndex()
    {
        $news = News::orderBy('published_at', 'desc')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function newsCreate()
    {
        return view('admin.news.create');
    }

    public function newsStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
            'published_at' => 'nullable|date',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }
        News::create($validated);
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function newsEdit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function newsUpdate(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image',
            'published_at' => 'nullable|date',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }
        $news->update($validated);
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diupdate');
    }

    public function newsDestroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->image) {
            Storage::delete('public/'.$news->image);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus');
    }
}
