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
use Illuminate\Support\Facades\Log;

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
        $pendingDeliveries = Delivery::where('status', 'pending')->count();
        $recentOrders = Order::with(['user', 'delivery'])->orderBy('created_at', 'desc')->take(5)->get();

        // Statistik pengiriman
        $activeDeliveries = Delivery::whereIn('status', ['assigned', 'picked_up', 'on_way'])->count();
        $completedDeliveries = Delivery::where('status', 'delivered')->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'pendingDeliveries',
            'recentOrders',
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
            try {
                // Coba upload ke direktori baru
                $imagePath = $request->file('image')->store('product_images', 'public');
                $product->image = $imagePath;

                // Log untuk debugging
                Log::info('Image uploaded successfully: ' . $imagePath);
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Gagal mengupload gambar: ' . $e->getMessage())->withInput();
            }
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
            try {
                // Hapus gambar lama jika ada
                if ($product->image) {
                    Storage::delete('public/'.$product->image);
                }
                $imagePath = $request->file('image')->store('product_images', 'public');
                $product->image = $imagePath;

                // Log untuk debugging
                Log::info('Image updated successfully: ' . $imagePath);
            } catch (\Exception $e) {
                Log::error('Image update failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Gagal mengupload gambar: ' . $e->getMessage())->withInput();
            }
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui');
    }

    // Manajemen Pesanan
    public function orders()
    {
        $orders = Order::with(['user', 'details.product', 'delivery'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function orderDetail($id)
    {
        $order = Order::with(['user', 'details.product', 'delivery'])->findOrFail($id);

        return view('admin.orders.detail', compact('order'));
    }

    // Method ini dihapus karena status order sekarang diambil dari delivery

    // Manajemen Pengiriman
    public function deliveries()
    {
        $deliveries = Delivery::with(['order.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.deliveries.index', compact('deliveries'));
    }

    public function deliveryDetail($id)
    {
        $delivery = Delivery::with(['order.user', 'order.details.product'])
            ->findOrFail($id);

        return view('admin.deliveries.detail', compact('delivery'));
    }

    // Update Status Pengiriman (Admin sebagai kurir)
    public function updateDeliveryStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:assigned,picked_up,on_way,delivered,failed',
            'notes' => 'nullable|string|max:500'
        ]);

        $delivery = Delivery::findOrFail($id);
        $oldStatus = $delivery->status;
        $delivery->status = $request->status;
        $delivery->notes = $request->notes;
        $delivery->save();

        // Buat notifikasi untuk customer jika sudah dikirim
        if ($request->status == 'delivered') {
            Notification::create([
                'user_id' => $delivery->order->user_id,
                'title' => 'Pesanan Dikirim',
                'message' => 'Pesanan #' . $delivery->order->order_number . ' telah berhasil dikirim',
                'type' => 'delivery_completed'
            ]);
        }

        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui');
    }

    // Update status pengiriman ke picked_up (Admin sebagai kurir)
    public function acceptDelivery($id)
    {
        $delivery = Delivery::where('status', 'assigned')
            ->findOrFail($id);

        $delivery->status = 'picked_up';
        $delivery->save();

        return redirect()->back()->with('success', 'Pengiriman berhasil diambil');
    }

    // Daftar pengiriman yang tersedia
    public function availableDeliveries()
    {
        $availableDeliveries = Delivery::where('status', 'assigned')
            ->with(['order.user', 'order.orderDetails.product'])
            ->get();

        return view('admin.deliveries.available', compact('availableDeliveries'));
    }

    // Riwayat pengiriman
    public function deliveryHistory()
    {
        $deliveries = Delivery::with(['order.user', 'order.orderDetails.product'])
            ->whereIn('status', ['delivered', 'failed'])
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('admin.deliveries.history', compact('deliveries'));
    }

    // Quick Update Status Pengiriman - Halaman khusus untuk admin di lapangan
    public function quickUpdateDeliveries()
    {
        try {
            $activeDeliveries = Delivery::with(['order.user'])
                ->whereIn('status', ['assigned', 'picked_up', 'on_way'])
                ->orderBy('updated_at', 'desc')
                ->get();

            Log::info('Quick Update: Found ' . $activeDeliveries->count() . ' active deliveries');
            return view('admin.deliveries.quick-update', compact('activeDeliveries'));
        } catch (\Exception $e) {
            Log::error('Quick Update Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Quick Update Status - AJAX endpoint untuk update cepat
    public function quickUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:assigned,picked_up,on_way,delivered,failed',
            'notes' => 'nullable|string|max:200'
        ]);

        $delivery = Delivery::findOrFail($id);
        $oldStatus = $delivery->status;
        $delivery->status = $request->status;

        if ($request->notes) {
            $delivery->notes = $request->notes;
        }

        $delivery->save();

        // Buat notifikasi untuk customer jika sudah dikirim
        if ($request->status == 'delivered') {
            Notification::create([
                'user_id' => $delivery->order->user_id,
                'title' => 'Pesanan Dikirim',
                'message' => 'Pesanan #' . $delivery->order->order_number . ' telah berhasil dikirim',
                'type' => 'delivery_completed'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status pengiriman #' . $delivery->tracking_number . ' berhasil diupdate',
            'new_status' => $request->status,
            'status_text' => ucwords(str_replace('_', ' ', $request->status))
        ]);
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
