<?php

namespace App\Enums;

enum OrderDetailsStatus : string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}
