<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('seller_id','order_id','price','discount','discount_price',
    'count','product_id','color_id','guaranty_id')]
class OrderDetail extends Model
{
    use SoftDeletes;

    //---Relations ----//

    public function seller():BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function color():BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function guaranty():BelongsTo
    {
        return $this->belongsTo(Guaranty::class);
    }
}
