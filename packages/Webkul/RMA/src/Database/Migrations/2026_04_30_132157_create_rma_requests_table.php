<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rma_requests', function (Blueprint $table) {
            $table->id();
            
            // Customer And Order References
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('order_id');
            
            // Product Information
            $table->string('product_sku');
            $table->string('product_name');
            $table->integer('product_quantity');
            
            // Return Details
            $table->string('status')->default('pending');
            $table->string('reason')->nullable();
            
            // Comments And Notes
            $table->text('admin_notes')->nullable();
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rma_requests');
    }
};