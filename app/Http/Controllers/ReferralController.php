<?php

namespace App\Http\Controllers;

use App\Services\ReferralService;
use App\Models\ReferralUse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    protected $referralService;

    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }

    public function index()
    {
        $user = Auth::user();
        $stats = $this->referralService->getReferralStats($user);
        $settings = $this->referralService->getActiveSettings();

        return view('customer.referral.index', compact('stats', 'settings'));
    }

    public function validateCode(Request $request)
    {
        $request->validate([
            'referral_code' => 'required|string|max:8'
        ]);

        $user = $this->referralService->validateReferralCode($request->referral_code);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Kode referral tidak valid'
            ]);
        }

        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menggunakan kode referral sendiri'
            ]);
        }

        $settings = $this->referralService->getActiveSettings();

        return response()->json([
            'success' => true,
            'message' => 'Kode referral valid',
            'data' => [
                'referrer_name' => $user->name,
                'discount_amount' => $settings->referred_discount_amount
            ]
        ]);
    }

    public function getReferralHistory()
    {
        $user = Auth::user();
        $referralUses = ReferralUse::where('referred_id', $user->id)
            ->with(['referrer', 'order'])
            ->where('type', 'referred_used')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.referral.history', compact('referralUses'));
    }

    public function showDiscounts()
    {
        $user = Auth::user();
        $availableDiscounts = $this->referralService->getAvailableDiscounts($user);

        return view('customer.referral.discounts', compact('availableDiscounts'));
    }

    public function getAvailableDiscounts()
    {
        $user = Auth::user();
        $discounts = $this->referralService->getAvailableDiscounts($user);

        return response()->json([
            'success' => true,
            'discounts' => $discounts->map(function($discount) {
                return [
                    'id' => $discount->id,
                    'discount_amount' => $discount->discount_amount,
                    'created_at' => $discount->created_at->format('d/m/Y')
                ];
            })
        ]);
    }

    public function useDiscount(Request $request)
    {
        $user = Auth::user();
        $referralUseId = $request->input('referral_use_id');

        $referralUse = ReferralUse::where('referrer_id', $user->id)
            ->where('id', $referralUseId)
            ->where('type', 'referrer_earned')
            ->where('is_used', false)
            ->first();

        if (!$referralUse) {
            return response()->json([
                'success' => false,
                'message' => 'Diskon tidak tersedia'
            ]);
        }

        // Store discount in session for checkout
        session(['referral_discount' => [
            'id' => $referralUse->id,
            'amount' => $referralUse->discount_amount
        ]]);

        return response()->json([
            'success' => true,
            'message' => 'Diskon siap digunakan pada checkout',
            'data' => [
                'discount_amount' => $referralUse->discount_amount
            ]
        ]);
    }
}
