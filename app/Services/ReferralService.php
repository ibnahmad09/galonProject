<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\ReferralSetting;
use App\Models\ReferralUse;
use Illuminate\Support\Facades\DB;

class ReferralService
{
    /**
     * Apply first order discount for referred user
     */
    public function applyFirstOrderDiscount(Order $order)
    {
        $user = User::find($order->user_id);
        if (!$user || !$user->referred_by) {
            return false;
        }

        $settings = ReferralSetting::getActive();
        if (!$settings || !$settings->is_active) {
            return false;
        }

        // Find unused referral discount for this user
        $referralUse = ReferralUse::where('referred_id', $user->id)
            ->where('type', 'referred_used')
            ->where('is_used', false)
            ->first();

        if (!$referralUse) {
            return false;
        }

        // Mark as used and link to order
        $referralUse->update([
            'order_id' => $order->id,
            'is_used' => true
        ]);

        // Update order total
        $order->update([
            'total_price' => $order->total_price - $referralUse->discount_amount
        ]);

        return $referralUse;
    }

    /**
     * Use referrer's earned discount
     */
    public function useReferrerDiscount(Order $order, int $referrerId)
    {
        $settings = ReferralSetting::getActive();
        if (!$settings || !$settings->is_active) {
            return false;
        }

        // Find unused referrer discount
        $referralUse = ReferralUse::where('referrer_id', $referrerId)
            ->where('type', 'referrer_earned')
            ->where('is_used', false)
            ->first();

        if (!$referralUse) {
            return false;
        }

        // Mark as used and link to order
        $referralUse->update([
            'order_id' => $order->id,
            'is_used' => true
        ]);

        // Update order total
        $order->update([
            'total_price' => $order->total_price - $referralUse->discount_amount
        ]);

        return $referralUse;
    }

    /**
     * Get referral statistics for user
     */
    public function getReferralStats(User $user)
    {
        // Hitung berapa banyak customer yang menggunakan kode referral
        $referrals = ReferralUse::where('referrer_id', $user->id)
            ->where('type', 'referred_used')
            ->count();

        $totalDiscountGiven = ReferralUse::where('referrer_id', $user->id)
            ->where('type', 'referred_used')
            ->where('is_used', true)
            ->sum('referred_discount_amount');
        $totalDiscountReceived = $user->referralUsesAsReferred()
            ->where('type', 'referred_used')
            ->where('is_used', true)
            ->sum('discount_amount');

        $availableDiscounts = ReferralUse::where('referrer_id', $user->id)
            ->where('type', 'referrer_earned')
            ->where('is_used', false)
            ->count();

        return [
            'referrals_count' => $referrals,
            'total_discount_given' => $totalDiscountGiven,
            'total_discount_received' => $totalDiscountReceived,
            'available_discounts' => $availableDiscounts,
            'referral_code' => $user->getReferralCode()
        ];
    }

    /**
     * Validate referral code
     */
    public function validateReferralCode(string $code)
    {
        $user = User::where('referral_code', $code)->first();
        if (!$user) {
            return false;
        }

        $settings = ReferralSetting::getActive();
        if (!$settings || !$settings->is_active) {
            return false;
        }

        return $user;
    }

    /**
     * Get available discounts for user
     */
    public function getAvailableDiscounts(User $user)
    {
        return ReferralUse::where('referrer_id', $user->id)
            ->where('type', 'referrer_earned')
            ->where('is_used', false)
            ->get();
    }

    /**
     * Get active referral settings
     */
    public function getActiveSettings()
    {
        return ReferralSetting::getActive();
    }
}
