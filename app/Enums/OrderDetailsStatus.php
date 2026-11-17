<?php

namespace App\Enums;

enum OrderDetailsStatus : string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case SEND_BY_SELLER = 'send by seller';
}
