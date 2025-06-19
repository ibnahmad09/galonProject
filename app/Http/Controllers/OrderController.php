<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\StockMutation;
use Illuminate\Support\Facades\Auth;
use App\Models\Delivery;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('customer.cart')->with('error', 'Keranjang kosong');
        }

        $totalPrice = 0;
        foreach ($cartItems as $itemId => $item) {
            $product = Product::find($itemId);
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Simpan ke database
        $order = new Order();
        $order->user_id = Auth::id();
        $order->order_number = 'ORD-' . uniqid();
        $order->total_price = $totalPrice;
        $order->payment_method = $request->payment_method;
        $order->delivery_address = $request->delivery_address;
        $order->status = 'pending';
        $order->save();

        foreach ($cartItems as $itemId => $item) {
            $product = Product::find($itemId);
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $itemId,
                'quantity' => $item['quantity'],
                'price_at_order' => $item['price']
            ]);
        }

        // Buat pengiriman
        $delivery = new Delivery();
        $delivery->order_id = $order->id;
        $delivery->tracking_number = 'TRK-' . uniqid();
        $delivery->status = 'on_route';
        $delivery->save();
        
        session()->forget('cart');
        return redirect()->route('customer.order.history')->with('success', 'Pesanan berhasil dibuat');
    }
}