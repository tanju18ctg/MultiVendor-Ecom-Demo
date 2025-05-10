<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class);
    }



    public function scopeHouseOrders($query){
        return $query->where('seller_id',NULL);
    }

}
