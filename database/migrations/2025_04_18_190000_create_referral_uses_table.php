<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referral_uses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referrer_id')->constrained('users')->onDelete('cascade'); // Yang mengajak
            $table->foreignId('referred_id')->constrained('users')->onDelete('cascade'); // Yang diajak
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade'); // Order yang menggunakan referral (nullable untuk referrer)
            $table->decimal('discount_amount', 10, 2); // Jumlah diskon yang diberikan
            $table->decimal('referrer_discount_amount', 10, 2)->default(0); // Diskon untuk referrer
            $table->decimal('referred_discount_amount', 10, 2)->default(0); // Diskon untuk referred
            $table->enum('type', ['referrer_earned', 'referred_used']); // Tipe penggunaan: referrer_earned = diskon untuk pengajak, referred_used = diskon untuk yang diajak
            $table->boolean('is_used')->default(false); // Status penggunaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_uses');
    }
};
