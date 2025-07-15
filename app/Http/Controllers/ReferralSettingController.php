<?php

namespace App\Http\Controllers;

use App\Models\ReferralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferralSettingController extends Controller
{
    public function index()
    {
        $settings = ReferralSetting::getActive() ?? new ReferralSetting();
        return view('admin.referral-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'referrer_discount_amount' => 'required|numeric|min:0',
            'referred_discount_amount' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $settings = ReferralSetting::getActive();
        if (!$settings) {
            $settings = new ReferralSetting();
        }

        $settings->fill($request->only([
            'referrer_discount_amount',
            'referred_discount_amount',
            'is_active'
        ]));
        $settings->save();

        return redirect()->route('admin.referral-settings.index')
            ->with('success', 'Pengaturan referral berhasil diperbarui');
    }
}
