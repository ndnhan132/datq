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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('parent_id')->nullable(); // Liên kết sản phẩm cha (nếu là biến thể)

            $table->string("kiotviet_id")->nullable()->default("");
            $table->string("fullname_vi");
            $table->string("fullname_zh")->nullable();
            $table->string("slug")->nullable()->unique();
            $table->text("description_vi")->nullable();
            $table->text("description_zh")->nullable();
            // $table->integer('price')->default(0);
            // $table->integer('cost_price')->default(0);
            // $table->integer('discount')->default(0);
            // $table->integer('quantity')->default(0);
            $table->string("unit");
            // $table->unsignedInteger('sold_quantity')->default(0);
            // $table->integer('base_price'); // Giá chung (nếu không có biến thể)
 
            $table->boolean('is_featured')->default(0);
            // $table->boolean('public')->default(1);


            // $table->string("variant_title")->default("")->nullable(); // dành cho các biến thể
            // $table->integer('package_item_count')->nullable()->default("0"); // Đơn vị tính số lượng (1, 6, 24 lon,...)
            // $table->string('package_item_unit')->nullable(); // Đơn vị (lon, kg,...)
            // $table->decimal('net_unit_value', 10, 2)->nullable()->default("0"); // đơn vji tỉ lệ ( 0.1 0.2 ...kg)
            // // $table->integer('price')->default(0); // Giá bán
            // // $table->integer('cost_price')->default(0); // giá nhập
            // $table->integer('discount_percent')->default(0); // Giá bán
            // $table->integer('stock_quantity')->default(0); // Số lượng tồn kho
            // // $table->json('attributes')->nullable(); // Thuộc tính bổ sung
            // // $table->unsignedInteger('sold_quantity')->default(0);


            // $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');



            $table->timestamps();
        });
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 10000;');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
