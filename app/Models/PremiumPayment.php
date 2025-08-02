<?php

namespace App\Models;

use App\Enums\PremiumPaymentStatus;
use Illuminate\Database\Eloquent\Model;

class PremiumPayment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'chapa_response' => 'array',
        'paid_at' => 'datetime',
        'status' => PremiumPaymentStatus::class,
    ];

    public function markAsSuccessAndUpgrade()
    {
        $this->update([
            'status' => PremiumPaymentStatus::SUCCESS,
            'paid_at' => now()
        ]);

        if ($this->user && !$this->user->hasRole('Premium')) {
            $this->user->assignRole('Premium');
        }

        return true;
    }

    public function hasSuccess()
    {
        return $this->status === PremiumPaymentStatus::SUCCESS;
    }

    public function isPending()
    {
        return $this->status === PremiumPaymentStatus::PENDING;
    }

    public function markAsFailed()
    {
        $this->update(['status' => PremiumPaymentStatus::FAILED]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
