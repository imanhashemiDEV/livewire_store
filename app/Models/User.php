<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password','mobile','is_active','is_admin','avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable,HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mobile_verified_at' => 'datetime',
            'is_active'         => 'boolean',
            'is_admin'         => 'boolean',
            'password' => 'hashed',
        ];
    }


    // ---- Relationships ----

//    public function vendor(): HasOne
//    {
//        return $this->hasOne(Vendor::class);
//    }
//
//    public function orders(): HasMany
//    {
//        return $this->hasMany(Order::class);
//    }
//
//    public function reviews(): HasMany
//    {
//        return $this->hasMany(Review::class);
//    }
//
//    public function addresses(): HasMany
//    {
//        return $this->hasMany(Address::class);
//    }
//
//    public function carts(): HasMany
//    {
//        return $this->hasMany(Cart::class);
//    }
//
//    public function wishlists(): BelongsToMany
//    {
//        return $this->belongsToMany(Product::class, 'wishlists')
//            ->withTimestamps();
//    }
//
//    public function transactions(): HasMany
//    {
//        return $this->hasMany(Transaction::class);
//    }
//
//    // ---- Helpers ----
//
//    public function isVendor(): bool
//    {
//        return $this->role === 'vendor';
//    }
//
//    public function defaultAddress()
//    {
//        return $this->addresses()->where('is_default', true)->first();
//    }
}
