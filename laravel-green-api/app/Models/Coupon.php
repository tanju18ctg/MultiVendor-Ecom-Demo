<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    // use for coupon apply time in cartcontroller
    public function discount($total)
    {
        if ($this->type == 'fixed') {
            // return number_format(round($this->value), 2);
            return round($this->value);
        } elseif ($this->type == 'percent') {
            // return number_format(round(($this->value / 100) * $total), 2);
            return round(($this->value / 100) * $total);
        } else {
            return 0;
        }


    }


    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeType($query, $status)
    {
        return $query->where('type', $status);
    }
}
