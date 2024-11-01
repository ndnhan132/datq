<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'photo_product');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
