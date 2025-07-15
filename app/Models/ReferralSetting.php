<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_discount_amount',
        'referred_discount_amount',
        'is_active'
    ];

    protected $casts = [
        'referrer_discount_amount' => 'decimal:2',
        'referred_discount_amount' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    /**
     * Get active referral settings
     */
    public static function getActive()
    {
        return static::where('is_active', true)->first();
    }
}
