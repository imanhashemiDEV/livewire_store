<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('title','image')]
class Brand extends Model
{
    use SoftDeletes;


    // -- relations

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
