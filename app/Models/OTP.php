<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OTP extends Model
{
    use HasFactory;

    protected $table = 'otps';

    protected $fillable = [
        'email',
        'otp_code',
        'attempts',
        'expires_at',
        'is_verified',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /**
     * Check if OTP is expired
     */
    public function isExpired(): bool
    {
        return Carbon::now()->isAfter($this->expires_at);
    }

    /**
     * Check if OTP is still valid
     */
    public function isValid(): bool
    {
        return !$this->isExpired() && !$this->is_verified;
    }

    /**
     * Increment attempts
     */
    public function incrementAttempts(): void
    {
        $this->increment('attempts');
    }

    /**
     * Check if max attempts exceeded
     */
    public function hasExceededAttempts(): bool
    {
        return $this->attempts >= 3;
    }

    /**
     * Mark OTP as verified
     */
    public function markAsVerified(): bool
    {
        return $this->update(['is_verified' => true]);
    }

    /**
     * Generate random OTP code
     */
    public static function generateCode(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create or update OTP for email
     */
    public static function createOrUpdateOTP(string $email): self
    {
        $otp = self::where('email', $email)->first() ?? new self();
        
        $otp->email = $email;
        $otp->otp_code = self::generateCode();
        $otp->expires_at = Carbon::now()->addMinutes(10);
        $otp->attempts = 0;
        $otp->is_verified = false;
        $otp->save();

        return $otp;
    }
}
