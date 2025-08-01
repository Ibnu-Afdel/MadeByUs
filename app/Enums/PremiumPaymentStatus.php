<?php

namespace App\Enums;

enum PremiumPaymentStatus: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';
    case FAILED = 'failed';
    case CANCELLED  = 'cancelled';
}
