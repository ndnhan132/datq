<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();

            $table->unsignedBigInteger('customer_id')->default('0')->foreign('customer_id')->references('id')->on('users')->onDelete
            ('RESTRICT'); // ID khách hàng
            $table->string('recipient_name')->default(""); // Tên người nhận
            $table->string('recipient_phone')->default(""); // Số điện thoại người nhận
            $table->text('recipient_address'); // Địa chỉ giao hàng

            
            $table->integer('sub_total')->default(0); // Tổng trước khi giảm giá, thuế, phí
            $table->integer('discount_total')->default(0); // Tổng tiền giảm giá
            $table->integer('tax')->default(0); // Thuế
            $table->integer('shipping_fee')->default(0); // Phí vận chuyển
            $table->integer('total_payable')->default(0); // Tổng số tiền phải thanh toán


            $table->string('payment_method'); // Phương thức thanh toán
            $table->boolean('payment_status')->default(0); // Phương thức thanh toán
            $table->text('order_note')->nullable(); // Ghi chú đơn hàng
            $table->enum('order_status', [
                'PENDING',      // ĐANG CHỜ XỬ LÝ
                'CONFIRMED',    // ĐÃ XÁC NHẬN
                'PROCESSING',   // ĐANG XỬ LÝ
                'SHIPPED',      // ĐÃ VẬN CHUYỂN
                'DELIVERED',    // ĐÃ GIAO HÀNG
                'COMPLETED',    // HOÀN TẤT
                'CANCELED',     // ĐÃ HỦY
                'RETURNED',     // ĐÃ TRẢ HÀNG
                'REFUNDED'      // ĐÃ HOÀN TIỀN
            ])->default('pending');

            $table->unsignedBigInteger('warehouse_id')->default('0')->references('id')->on('warehouses')->onDelete('RESTRICT'); // Kho lấy hàng gủi
            $table->unsignedBigInteger('handled_by')->default('0')->references('id')->on('users')->onDelete('RESTRICT'); // ID nhân viên xử lý
            $table->unsignedBigInteger('shipper_id')->default('0')->references('id')->on('users')->onDelete('RESTRICT'); // ID nhân viên vận chuyển

            
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
