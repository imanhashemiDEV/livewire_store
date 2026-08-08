<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('attribute_id','value')]
class AttributeValue extends Model
{





    //----- relations -------//

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

}
