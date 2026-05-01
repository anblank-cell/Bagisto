<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mp_flag_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // product, seller
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('mp_flags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flag_reason_id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->string('flaggable_type'); // product or seller
            $table->unsignedBigInteger('flaggable_id');
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('flag_reason_id')->references('id')->on('mp_flag_reasons')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mp_flags');
        Schema::dropIfExists('mp_flag_reasons');
    }
};
