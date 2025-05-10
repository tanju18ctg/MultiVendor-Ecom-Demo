<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getRouteKeyName(){
        return 'slug';
    }


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
        return $this->hasMany(Product::class)->published();
    }

    //with active subcategories
    public function subcategories(){
        return $this->hasMany(Subcategory::class)->published();
    }

    //with all categories
    public function subcats(){
        return $this->hasMany(Subcategory::class);
    }

    //pass the accessor and miutator with laravel site link

    // public function getUrlAttribute($value){
    //     return env('APP_URL').'/'.$value;
    // }
}
