<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Seller extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeIsVerified($query, $status)
    {
        return $query->where('isVerified', $status);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->sellerProducts();
    }

    public function files()
    {
        return $this->hasMany(SellerFileSystem::class);
    }
}
