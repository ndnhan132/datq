<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Invoice::class, 'order_product')
                    ->withPivot('quantity', 'cost_price', 'final_price') // Trường trung gian
                    ->withTimestamps();
    }
}
