<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mp_seller_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedInteger('product_id');
            $table->boolean('is_owner')->default(true);
            $table->boolean('is_approved')->default(false);
            $table->decimal('price', 12, 4)->nullable();
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('mp_sellers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unique(['seller_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mp_seller_products');
    }
};
