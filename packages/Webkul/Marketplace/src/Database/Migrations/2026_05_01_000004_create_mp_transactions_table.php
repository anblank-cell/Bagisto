<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mp_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('seller_order_id')->nullable();
            $table->decimal('amount', 12, 4);
            $table->string('type')->default('payout'); // payout, commission
            $table->string('status')->default('pending'); // pending, completed
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('mp_sellers')->onDelete('cascade');
            $table->foreign('seller_order_id')->references('id')->on('mp_seller_orders')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mp_transactions');
    }
};
