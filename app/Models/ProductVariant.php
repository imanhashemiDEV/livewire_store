<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('price','discount','discount_price','count','max_sell','status','product_id','color_id','guarranty_id','seller_id')]
class ProductVariant extends Model
{
    use SoftDeletes;

    // ----- relations ------//

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function guarranty()
    {
        return $this->belongsTo(Guarranty::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function scopeActiveProductVariant($query)
    {
        return $query->where('status', ProductStatus::Active->value);
    }
}
