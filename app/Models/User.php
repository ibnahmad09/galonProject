<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ReferralUse;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'referral_code',
        'referred_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'courier_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referralUsesAsReferrer()
    {
        return $this->hasMany(ReferralUse::class, 'referrer_id');
    }

    public function referralUsesAsReferred()
    {
        return $this->hasMany(ReferralUse::class, 'referred_id');
    }

    /**
     * Generate unique referral code
     */
    public function generateReferralCode()
    {
        do {
            $code = strtoupper(substr(md5(uniqid()), 0, 8));
        } while (static::where('referral_code', $code)->exists());

        $this->update(['referral_code' => $code]);
        return $code;
    }

    /**
     * Get referral code or generate if not exists
     */
    public function getReferralCode()
    {
        if (!$this->referral_code) {
            $this->generateReferralCode();
        }
        return $this->referral_code;
    }
}
