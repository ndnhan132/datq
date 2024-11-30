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
    // public function orders()
    // {
    //     return $this->belongsToMany(Invoice::class, 'order_product')
    //                 ->withPivot('quantity', 'cost_price', 'final_price') // Trường trung gian
    //                 ->withTimestamps();
    // }
    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'photo_product');
    }

    // Liên kết 1-n với ProductVariant
    // public function variants()
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    // public function parent()
    // {
    //     return $this->belongsTo(self::class, 'parent_id');
    // }

    // Liên kết với các biến thể con
    // public function variants()
    // {
    //     return $this->hasMany(self::class, 'parent_id');
    // }
    // // Kiểm tra nếu là sản phẩm cha
    // public function isParent()
    // {
    //     return is_null($this->parent_id);
    // }
}
