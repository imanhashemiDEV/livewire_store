<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

#[Fillable('lowest_product_id','title','e_title','slug','description','price','discount'
,'discount_price','viewed','sold','status','category_id','brand_id')]
class Product extends Model implements HasMedia
{
    use SoftDeletes,InteractsWithMedia;



    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->fit(Fit::Contain, 200, 200)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->useFallbackUrl('/panel/images/image.png')
            ->useFallbackPath(public_path('/panel/images/image.png'));
    }

    // -- relations

    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function product_attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function scopeActiveProduct($query)
    {
        return $query->whereHas('product_variants',function ($query){
            $query->where('status', ProductStatus::Active->value);
        })->where('status', ProductStatus::Active->value);
    }
}
