<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\StockMutation;
use Illuminate\Support\Facades\Auth;
use App\Models\Delivery;
use App\Models\ReferralUse;
use App\Services\ReferralService;
use Midtrans\Snap;
use Midtrans\Config;

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

                        // Apply available referral discount from session
        $sessionDiscount = session('referral_discount');
        if ($sessionDiscount) {
            $totalPrice -= $sessionDiscount['amount'];
            // Mark discount as used
            $referralUse = ReferralUse::find($sessionDiscount['id']);
            if ($referralUse) {
                $referralUse->update([
                    'is_used' => true,
                    'order_id' => null // Will be updated after order is created
                ]);
            }
            session()->forget('referral_discount');
        }

        // Simpan ke database
        $order = new Order();
        $order->user_id = Auth::id();
        $order->order_number = 'ORD-' . uniqid();
        $order->total_price = $totalPrice;
        $order->payment_method = $request->payment_method;
        $order->delivery_address = $request->delivery_address;
        $order->save();

        // Apply first order discount if user was referred
        $referralService = new ReferralService();
        $referralService->applyFirstOrderDiscount($order);



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
        $delivery->status = 'assigned';
        $delivery->save();

        // Buat notifikasi untuk admin bahwa ada pesanan baru siap dikirim
        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'title' => 'Pesanan Baru Siap Dikirim',
                'message' => 'Pesanan #' . $order->order_number . ' telah siap untuk dikirim',
                'type' => 'new_order_ready'
            ]);
        }

        if ($request->payment_method == 'Midtrans') {
            // Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false; // Ganti true jika production
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => $request->phone,
                    'address' => $request->delivery_address,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            session()->forget('cart');
            return view('customer.midtrans-payment', compact('snapToken', 'order'));
        }

        session()->forget('cart');
        return redirect()->route('customer.order.history')->with('success', 'Pesanan berhasil dibuat');
    }
}
