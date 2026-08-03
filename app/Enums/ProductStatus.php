<?php

namespace App\Enums;

enum ProductStatus :string
{
    case Waiting = 'waiting';
    case Active = 'active';
    case Rejected = 'rejected';
    case Ended = 'ended';
}
