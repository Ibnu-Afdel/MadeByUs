<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected'; 
}
