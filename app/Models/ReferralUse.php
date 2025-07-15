<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralUse extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'referred_id',
        'order_id',
        'discount_amount',
        'referrer_discount_amount',
        'referred_discount_amount',
        'type',
        'is_used'
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
        'referrer_discount_amount' => 'decimal:2',
        'referred_discount_amount' => 'decimal:2',
        'is_used' => 'boolean'
    ];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
