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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->integer('discount_price')->default(0);
            $table->integer('count')->default(0);
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('color_id')->constrained('colors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('guaranty_id')->constrained('guaranties')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status')->default(\App\Enums\OrderDetailsStatus::PENDING->value);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
