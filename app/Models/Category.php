<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

#[Fillable('title','slug','parent_id')]
class Category extends Model
{
    use HasRecursiveRelationships;

    public static function getAllCategories()
    {
        $array=[];
        $categories =  Category::query()->with('children')->WhereNull('parent_id')->get();
        foreach ($categories as $category){
            $array[$category->id]=$category->title;
            foreach ($category->children as $cat1){
                $array[$cat1->id]= ' - ' . $cat1->title;
            }
        }
        return $array;
    }
}
