<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mp_seller_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedInteger('order_id');
            $table->decimal('base_grand_total', 12, 4)->default(0);
            $table->decimal('grand_total', 12, 4)->default(0);
            $table->decimal('commission', 12, 4)->default(0);
            $table->decimal('seller_total', 12, 4)->default(0);
            $table->string('status')->default('pending');
            $table->boolean('is_paid')->default(false);
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('mp_sellers')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mp_seller_orders');
    }
};
