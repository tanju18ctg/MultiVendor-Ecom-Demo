<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'division_id',
        'district_id',
        'address',
        'name',
        'email',
        'image',
        'phone',
        'isVerified',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
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


    //use for login with phone number

    public function findForPassport($username)
    {
        $customUsername = 'phone';
        return $this->where($customUsername, $username)->first();
    }

    //many to many relationship in proudct_user migration.. for wishlist
    public function wishlistProduct(){
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }



    // Owerride password here
    // public function validateForPassportPasswordGrant($password)
    // {
    //     $owerridedPassword = 'password';
    //     return Hash::check($password, $this->password);
    // }

     //use for login with phone number
}
