<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

        /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function scopeStatus($query,$status){
        return $query->where('status',$status);
    }


          //Published()
          public function scopePublished($query){
            return $query->where('status','active');
        }

         //Unpiblished()
         public function scopeUnpublished($query){
            return $query->where('status','inactive');
        }


        public function products(){
            return $this->hasMany(Product::class);
        }

        public function category(){
            return $this->belongsTo(Category::class);
        }
}
