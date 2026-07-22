<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

#[Fillable('title','slug','parent_id')]
class Category extends Model
{
    use HasRecursiveRelationships, SoftDeletes;

    public static function getAllCategories()
    {
        $array=[];
        $categories =  Category::query()->with('children')->WhereNull('parent_id')->get();
        foreach ($categories as $category){
            $array[$category->id]= ' - ' . $category->title;
            foreach ($category->children as $cat1){
                $array[$cat1->id]= ' -- ' . $cat1->title;
            }
        }
        return $array;
    }

    protected static function boot()
    {
        parent::boot();
        self::deleting(function ($category) {
            foreach ($category->children as $child){
                $child->delete();
            }
        });

        self::restoring(function ($category) {
            foreach ($category->children()->withTrashed()->get() as $child){
                $child->restore();
            }
        });
    }
}
