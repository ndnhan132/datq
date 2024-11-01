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
            $table->string("name");
            $table->string("slug");
            $table->text("description")->nullable();
            $table->integer('price')->default(0);
            $table->integer('cost_price')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('quantity')->default(0);
            $table->string("unit_of_measurement");
            
            $table->unsignedBigInteger('pho')->default('0')->foreign('customer_id')->references('id')->on('users')->onDelete
            ('RESTRICT');

            $table->boolean('is_featured')->default(0);
            $table->boolean('public')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
