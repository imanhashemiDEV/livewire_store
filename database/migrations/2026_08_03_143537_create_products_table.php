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
            $table->string('title');
            $table->string('e_title')->nullable();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->integer('count')->default(0);
            $table->integer('viewed')->default(0);
            $table->integer('sold')->default(0);
            $table->integer('max_sell')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default(\App\Enums\ProductStatus::Waiting->value);
            $table->foreignId('seller_id')->constrained('sellers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('guarranty_id')->constrained('guarranties')->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
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
