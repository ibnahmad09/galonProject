<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Delivery;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function __construct()
    {
        $this->middleware('courier');
    }

    // Dashboard Kurir
    public function dashboard()
    {
        $deliveries = Delivery::where('courier_id', auth()->id())->get();
        return view('courier.dashboard', compact('deliveries'));
    }

    // Update Status Pengiriman
    public function updateDeliveryStatus(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->status = $request->status;
        $delivery->save();

        // Update status pesanan jika sudah dikirim
        if ($request->status == 'delivered') {
            $delivery->order->status = 'delivered';
            $delivery->order->save();
        }

        return redirect()->back()->with('success', 'Status pengiriman diperbarui');
    }
}