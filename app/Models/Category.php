<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

#[Fillable('title','slug','parent_id')]
class Category extends Model
{
    use HasRecursiveRelationships;
}
