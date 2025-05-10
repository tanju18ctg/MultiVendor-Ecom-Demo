<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

        /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

}
