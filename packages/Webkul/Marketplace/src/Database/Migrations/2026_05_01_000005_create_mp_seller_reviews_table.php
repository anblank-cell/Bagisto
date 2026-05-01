<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mp_seller_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->tinyInteger('rating')->default(5);
            $table->string('title');
            $table->text('comment');
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('mp_sellers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mp_seller_reviews');
    }
};
