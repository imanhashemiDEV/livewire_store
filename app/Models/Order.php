<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('user_id','transaction_id','discount_id','send_type_id',
    'payment_type_id','order_code','receiver_name','receiver_family','province',
    'city' , 'address', 'phone','postal_code','description','total_price','total_discount',
    'total_discount_price', 'status' )]
class Order extends Model
{
    use SoftDeletes;

    //---Relations ---//

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function discount():BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

    public function paymentType():BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function sendType():BelongsTo
    {
        return $this->belongsTo(SendType::class);
    }

    public function orderDetails():HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}

