<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = ['order_status'];

    // Danh sách trạng thái hợp lệ
    private $statusFlow = [
        'INITIATED' => ['USER_CONFIRMED'],
        // 'USER_CONFIRMED' => ['PENDING'],
        'PENDING' => ['SHOP_CONFIRMED'],
        'SHOP_CONFIRMED' => ['PROCESSING'],
        'PROCESSING' => ['SHIPPED'],
        'SHIPPED' => ['DELIVERED'],
        'DELIVERED' => ['COMPLETED'],
        'COMPLETED' => [],
        'CANCELED' => [],
        'RETURNED' => ['REFUNDED'],
        'REFUNDED' => [],
    ];


    // Kiểm tra trạng thái có thể chuyển đổi
    public function canChangeStatus(string $newStatus): bool
    {
        $currentStatus = $this->order_status;

        return in_array($newStatus, $this->statusFlow[$currentStatus] ?? []);
    }

    // Chuyển đổi trạng thái
    public function updateStatus(string $newStatus): bool
    {
        if ($this->canChangeStatus($newStatus)) {

            $this->order_status = $newStatus;
            return $this->save();
        }

        return false;
    }

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot('quantity', 'cost_price', 'final_price') // Trường trung gian
                    ->withTimestamps();
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }


    
}
