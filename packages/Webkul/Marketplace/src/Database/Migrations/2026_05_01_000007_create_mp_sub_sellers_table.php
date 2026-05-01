<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mp_sub_sellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedInteger('customer_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->json('permissions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('mp_sellers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mp_sub_sellers');
    }
};
