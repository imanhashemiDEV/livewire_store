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
            $table->string('transaction_id')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->unsignedBigInteger('send_type_id');
            $table->unsignedBigInteger('payment_type_id');
            $table->string('order_code');
            $table->string('receiver_name');
            $table->string('receiver_family');
            $table->string('province');
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->string('postal_code');
            $table->string('description')->nullable();
            $table->float('total_price');
            $table->float('total_discount');
            $table->float('total_price');
            $table->string('status')->default(\App\Enums\OrderStatus::PENDING->value);
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
