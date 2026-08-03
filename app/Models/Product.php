<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('title','e_title','slug','description','price','discount'
,'count','viewed','sold','max_sell','image','status','seller_id'
,'category_id','brand_id','guarranty_id')]
class Product extends Model
{
    use SoftDeletes;
}
