<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('price','discount','discount_price','count','max_sell','status','color_id','guarranty_id','seller_id')]
class ProductVariant extends Model
{
    use SoftDeletes;
}
