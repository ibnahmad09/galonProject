<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ReferralService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $referralService;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $referralCode = $request->get('ref');
        return view('auth.register', compact('referralCode'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string'],
            'referral_code' => ['nullable', 'string', 'max:8']
        ]);

        // Check if referral code is valid
        $referrer = null;
        if ($request->filled('referral_code')) {
            $referrer = $this->referralService->validateReferralCode($request->referral_code);
            if (!$referrer) {
                return back()->withErrors(['referral_code' => 'Kode referral tidak valid']);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'phone' => $request->phone,
            'address' => $request->address,
            'referred_by' => $referrer ? $referrer->referral_code : null,
        ]);

        // Generate referral code for new user
        $user->generateReferralCode();

        // Apply referral discount if referral code was used
        if ($referrer) {
            $settings = $this->referralService->getActiveSettings();
            if ($settings && $settings->is_active) {
                // Create referral use record for referred user (will be used on first order)
                \App\Models\ReferralUse::create([
                    'referrer_id' => $referrer->id,
                    'referred_id' => $user->id,
                    'order_id' => null,
                    'discount_amount' => $settings->referred_discount_amount,
                    'referrer_discount_amount' => 0,
                    'referred_discount_amount' => $settings->referred_discount_amount,
                    'type' => 'referred_used',
                    'is_used' => false // Will be used on first order
                ]);

                // Create referral use record for referrer (earned discount)
                \App\Models\ReferralUse::create([
                    'referrer_id' => $referrer->id,
                    'referred_id' => $user->id,
                    'order_id' => null,
                    'discount_amount' => $settings->referrer_discount_amount,
                    'referrer_discount_amount' => $settings->referrer_discount_amount,
                    'referred_discount_amount' => 0,
                    'type' => 'referrer_earned',
                    'is_used' => false // Can be used anytime
                ]);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('customer.dashboard');
    }
}
