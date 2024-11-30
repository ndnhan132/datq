<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    //
    protected $fillable = [
        'variant_title',
        'net_unit_value',
        'price',
        'cost_price',
        'discount_percent',
        'stock_quantity',
        'sold_quantity',
    ];
 
        // Liên kết ngược với Product
        public function product()
        {
            return $this->belongsTo(Product::class);
        }

        public function orders()
        {
            return $this->belongsToMany(Invoice::class, 'order_product_variant')
                        ->withPivot('quantity', 'cost_price', 'final_price') // Trường trung gian
                        ->withTimestamps();
        }
}
