<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminFileSystem extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function scopeType($query,$type){
        return $query->where('type',$type);
    }

    public function seller(){
        return $this->belongsTo(Admin::class);
    }

}
