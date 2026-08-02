<?php

namespace App\Enums;

enum SellerStatus : string
{
    case Waiting = 'waiting';
    case Active = 'active';
    case Rejected = 'rejected';
    case Banned = 'banned';
}
