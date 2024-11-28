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
            $table->string("kiotviet_id")->nullable()->default("");
            $table->string("name_vi");
            $table->string("name_zh")->nullable();
            $table->string("slug");
            $table->text("description_vi")->nullable();
            $table->text("description_zh")->nullable();
            $table->integer('price')->default(0);
            $table->integer('cost_price')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('quantity')->default(0);
            $table->string("unit");
            $table->unsignedInteger('sold_quantity')->default(0);
            
 
            $table->boolean('is_featured')->default(0);
            $table->boolean('public')->default(1);

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
