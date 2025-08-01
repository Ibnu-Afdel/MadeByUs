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



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
