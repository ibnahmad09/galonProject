<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReferralSetting;

class ReferralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReferralSetting::create([
            'referrer_discount_amount' => 1000, // Rp 5.000 diskon untuk pengajak
            'referred_discount_amount' => 1000, // Rp 10.000 diskon untuk yang diajak
            'is_active' => true
        ]);
    }
}
