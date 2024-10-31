<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = [
        'order_id',
        'recipient_name',
        'recipient_phone',
        'recipient_address',
        'order_note',
        'sub_total',
        'discount_total',
        'tax',
        'shipping_fee',
        'total_payable',
        'payment_method',
        'order_status',

        
    ];
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product
        ')
                    ->withPivot('quantity', 'cost_price', 'final_price') // Trường trung gian
                    ->withTimestamps();
    }
}
