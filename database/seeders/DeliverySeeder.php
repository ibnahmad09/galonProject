<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;

class DeliverySeeder extends Seeder
{
    public function run()
    {
        $orders = Order::all();
        $couriers = User::where('role', 'courier')->get();

        foreach ($orders as $index => $order) {
            $status = ['pending', 'assigned', 'picked_up', 'on_way', 'delivered'][array_rand(['pending', 'assigned', 'picked_up', 'on_way', 'delivered'])];
            $courier = $status === 'pending' ? null : $couriers->random();

            Delivery::create([
                'order_id' => $order->id,
                'courier_id' => $courier ? $courier->id : null,
                'status' => $status,
                'tracking_number' => 'TRK' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                'notes' => $status === 'delivered' ? 'Pengiriman berhasil diselesaikan' : null,
            ]);
        }
    }
}
