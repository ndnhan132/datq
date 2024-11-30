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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // FK tới bảng products
            $table->string('variant_fullname_vi')->nullable()->default(""); // Tên biến thể (VD: "Thùng 24 lon", "300g")
            $table->string('variant_fullname_zh')->nullable()->default("");
            // $table->integer('package_item_count')->nullable()->default("0"); // Đơn vị tính số lượng (1, 6, 24 lon,...)
            // $table->string('package_item_unit')->nullable(); // Đơn vị (lon, kg,...)
            // $table->decimal('net_unit_value', 10, 2)->nullable()->default("0"); // đơn vji tỉ lệ ( 0.1 0.2 ...kg)
  

            $table->boolean('public')->default(1);


            $table->string("variant_title")->default("")->nullable(); // dành cho các biến thể
            $table->integer('package_item_count')->nullable()->default("0"); // Đơn vị tính số lượng (1, 6, 24 lon,...)
            $table->string('package_item_unit')->nullable(); // Đơn vị (lon, kg,...)
            $table->decimal('net_unit_value', 10, 2)->nullable()->default("0"); // đơn vji tỉ lệ ( 0.1 0.2 ...kg)
            $table->integer('price')->default(0); // Giá bán
            $table->integer('cost_price')->default(0); // giá nhập
            $table->integer('discount_percent')->default(0); // Giá bán
            $table->integer('stock_quantity')->default(0); // Số lượng tồn kho
            // $table->json('attributes')->nullable(); // Thuộc tính bổ sung
            $table->unsignedInteger('sold_quantity')->default(0);

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');



        });
        DB::statement('ALTER TABLE product_variants AUTO_INCREMENT = 10000;');


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
