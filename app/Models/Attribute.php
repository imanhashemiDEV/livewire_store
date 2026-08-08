<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('title','type')]
class Attribute extends Model
{




    //----- relations -------//

    public function attribute_values()
    {
       return $this->hasMany(AttributeValue::class);
    }
}
