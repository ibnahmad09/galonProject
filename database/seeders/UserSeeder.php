<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@depotairminum.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1'
        ]);

        // Create Customer User
        User::create([
            'name' => 'Customer',
            'email' => 'customer@depotairminum.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '082345678901',
            'address' => 'Jl. Customer No. 2'
        ]);

        // Create Courier User
        User::create([
            'name' => 'Kurir',
            'email' => 'kurir@depotairminum.com',
            'password' => Hash::make('password'),
            'role' => 'courier',
            'phone' => '083456789012',
            'address' => 'Jl. Kurir No. 3'
        ]);
    }
} 