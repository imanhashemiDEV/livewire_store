<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

#[Fillable('title','e_title','slug','description','price','discount'
,'count','viewed','sold','max_sell','status','category_id','brand_id')]
class Product extends Model implements HasMedia
{
    use SoftDeletes,InteractsWithMedia;



    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb200*200')
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
}
