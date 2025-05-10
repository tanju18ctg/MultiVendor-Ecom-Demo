<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

        /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

      //Published()
      public function scopePublished($query){
        return $query->where('status','active');
    }

    public function scopeStatus($query,$status){
        return $query->where('status',$status);
    }

}
