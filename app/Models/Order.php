<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'total_price', 'payment_method', 'delivery_address', 'delivery_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    // Method untuk mendapatkan status dari delivery
    public function getStatusAttribute()
    {
        if ($this->delivery) {
            return $this->delivery->status;
        }
        return 'pending';
    }

    // Method untuk mengecek apakah pesanan sudah selesai
    public function isCompleted()
    {
        return $this->delivery && $this->delivery->status === 'delivered';
    }

    // Method untuk mengecek apakah pesanan dibatalkan
    public function isCancelled()
    {
        return $this->delivery && $this->delivery->status === 'failed';
    }
}
