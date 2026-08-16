<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('price','discount','discount_price','count','max_sell','status','product_id','color_id','guarranty_id','seller_id')]
class ProductVariant extends Model
{
    use SoftDeletes;

    // ----- relations ------//

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
}
