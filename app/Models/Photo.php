<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{


    public function getPathAttribute($value)
    {
        return asset($value);  // Đảm bảo biến $value được xử lý qua asset()
    }

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'photo_product');
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
    
}
