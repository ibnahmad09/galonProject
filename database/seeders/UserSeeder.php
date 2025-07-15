<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@galon.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1',
            'referral_code' => Str::upper(Str::random(8)),
        ]);

        // Create Customer User
        User::create([
            'name' => 'Customer',
            'email' => 'customer@galon.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '081234567891',
            'address' => 'Jl. Customer No. 1',
            'referral_code' => Str::upper(Str::random(8)),
        ]);
    }
}
