<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('price','discount','discount_price','count','max_sell','status','product_id','color_id','guaranty_id','seller_id', 'lowest_product_id')]
class ProductVariant extends Model
{
    use SoftDeletes;

    // ----- relations ------//

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function guaranty(): BelongsTo
    {
        return $this->belongsTo(Guaranty::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function scopeActiveProductVariant($query)
    {
        return $query->where('status', ProductStatus::Active->value);
    }
}
