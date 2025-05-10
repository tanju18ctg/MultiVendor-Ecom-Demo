<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $casts = [
        'color' => 'json',
        'size' => 'json',
        'image' => 'json',
    ];



     //dynamic status
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

      //sale product
      public function scopeSaleproduct($query){
        return $query->where('sale',1);
    }

    //new product
    public function scopeConditionProduct($query,$condition){
        return $query->where('conditions',$condition);
    }

    //seller proudcts
    public function scopeSellerProducts($query){
        return $query->where('added_by','seller');
    }

    //admin added products
    public function scopeAdminProducts($query){
        return $query->where('added_by','admin');
    }


    public function scopeSlugProduct($query,$slug){
        return $query->where('slug',$slug);
    }

    //   //popular product
    //   public function scopePopularproduct($query){
    //     return $query->where('conditions','popular');
    // }

    //     //popular product
    //     public function scopeWinterproduct($query){
    //         return $query->where('conditions','winter');
    //     }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    // width: 50px;
    // margin-top: -30px;

     //many to many relationship with user and product so make another migration table product_user.. use for wishlist
     public function wishlistUsers(){
        return $this->belongsToMany(User::class);
    }


}
