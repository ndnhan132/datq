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
            $table->float('price')->default(0);
            $table->float('cost_price')->default(0);
            $table->float('discount')->default(0);
            $table->integer('quantity')->default(0);
            $table->string("unit_of_measurement");
            $table->string('image_url')->nullable();
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