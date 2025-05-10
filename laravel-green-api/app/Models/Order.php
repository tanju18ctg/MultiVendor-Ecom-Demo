<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function scopeStatus($query,$condition){
        return $query->where('status',$condition);
    }

    public function products(){
        return $this->belongsToMany(Product::class,'order_items')->withPivot('qty')->withTimestamps();
    }



}
