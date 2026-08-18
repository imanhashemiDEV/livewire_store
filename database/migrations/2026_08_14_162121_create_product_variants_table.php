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
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->integer('discount_price')->default(0);
            $table->integer('count')->default(0);
            $table->integer('max_sell')->nullable();
            $table->string('status')->default(\App\Enums\ProductStatus::Waiting->value);
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('color_id')->constrained('colors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('guarranty_id')->constrained('guarranties')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('seller_id')->constrained('sellers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
