<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('user_id','title','slug','phone',
    'address','logo','website','description','status')]
class Seller extends Model
{




    // ---- Relationships ----

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
