<?php

namespace App\Helpers;

use App\Models\Product;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;


class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        if ($media->model_type ==  "App\\Models\\Product") {

            return 'images/products/';
        }
    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}
