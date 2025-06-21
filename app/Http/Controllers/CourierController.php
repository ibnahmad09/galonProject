<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Delivery;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierController extends Controller
{
    public function __construct()
    {
        $this->middleware('courier');
    }

    // Dashboard Kurir
    public function dashboard()
    {
        $courierId = Auth::id();

        // Pengiriman yang sedang berlangsung
        $activeDeliveries = Delivery::where('courier_id', $courierId)
            ->whereIn('status', ['assigned', 'picked_up', 'on_way'])
            ->with(['order.user', 'order.orderDetails.product'])
            ->get();

        // Pengiriman yang sudah selesai hari ini
        $completedToday = Delivery::where('courier_id', $courierId)
            ->where('status', 'delivered')
            ->whereDate('updated_at', today())
            ->count();

        // Total pengiriman bulan ini
        $monthlyDeliveries = Delivery::where('courier_id', $courierId)
            ->where('status', 'delivered')
            ->whereMonth('updated_at', now()->month)
            ->count();

        // Notifikasi untuk kurir
        $notifications = Notification::where('user_id', $courierId)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('courier.dashboard', compact(
            'activeDeliveries',
            'completedToday',
            'monthlyDeliveries',
            'notifications'
        ));
    }

    // Daftar semua pengiriman
    public function deliveries()
    {
        $courierId = Auth::id();

        $deliveries = Delivery::where('courier_id', $courierId)
            ->with(['order.user', 'order.orderDetails.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('courier.deliveries', compact('deliveries'));
    }

    // Detail pengiriman
    public function deliveryDetail($id)
    {
        $delivery = Delivery::where('courier_id', Auth::id())
            ->with(['order.user', 'order.orderDetails.product'])
            ->findOrFail($id);

        return view('courier.delivery-detail', compact('delivery'));
    }

    // Update Status Pengiriman
    public function updateDeliveryStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:assigned,picked_up,on_way,delivered,failed',
            'notes' => 'nullable|string|max:500'
        ]);

        $delivery = Delivery::where('courier_id', Auth::id())->findOrFail($id);
        $oldStatus = $delivery->status;
        $delivery->status = $request->status;
        $delivery->notes = $request->notes;
        $delivery->save();

        // Update status pesanan jika sudah dikirim
        if ($request->status == 'delivered') {
            $delivery->order->status = 'delivered';
            $delivery->order->save();

            // Buat notifikasi untuk customer
            Notification::create([
                'user_id' => $delivery->order->user_id,
                'title' => 'Pesanan Dikirim',
                'message' => 'Pesanan #' . $delivery->order->order_number . ' telah berhasil dikirim',
                'type' => 'delivery_completed'
            ]);
        }

        // Buat notifikasi untuk admin
        Notification::create([
            'user_id' => 1, // Admin ID
            'title' => 'Status Pengiriman Diperbarui',
            'message' => 'Kurir ' . Auth::user()->name . ' mengubah status pengiriman #' . $delivery->tracking_number . ' dari ' . $oldStatus . ' ke ' . $request->status,
            'type' => 'delivery_status_updated'
        ]);

        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui');
    }

    // Terima pengiriman baru
    public function acceptDelivery($id)
    {
        $delivery = Delivery::where('courier_id', null)
            ->where('status', 'pending')
            ->findOrFail($id);

        $delivery->courier_id = Auth::id();
        $delivery->status = 'assigned';
        $delivery->save();

        // Buat notifikasi untuk admin
        Notification::create([
            'user_id' => 1, // Admin ID
            'title' => 'Pengiriman Diterima',
            'message' => 'Kurir ' . Auth::user()->name . ' menerima pengiriman #' . $delivery->tracking_number,
            'type' => 'delivery_accepted'
        ]);

        return redirect()->back()->with('success', 'Pengiriman berhasil diterima');
    }

    // Daftar pengiriman yang tersedia
    public function availableDeliveries()
    {
        $availableDeliveries = Delivery::where('courier_id', null)
            ->where('status', 'pending')
            ->with(['order.user', 'order.orderDetails.product'])
            ->get();

        return view('courier.available-deliveries', compact('availableDeliveries'));
    }

    // Riwayat pengiriman
    public function deliveryHistory()
    {
        $courierId = Auth::id();

        $deliveries = Delivery::where('courier_id', $courierId)
            ->whereIn('status', ['delivered', 'failed'])
            ->with(['order.user', 'order.orderDetails.product'])
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        return view('courier.delivery-history', compact('deliveries'));
    }

    // Mark notifikasi sebagai dibaca
    public function markNotificationAsRead($id)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['success' => true]);
    }
}
