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
        Schema::create('salesitems', function (Blueprint $table) {
            $table->id('SaleItemID');
            $table->unsignedBigInteger('SaleID')->nullable();
            $table->unsignedBigInteger('ProductID')->nullable();
            $table->integer('Quantity');
            $table->decimal('Price', 10, 2);
            
            // Foreign key constraints
            $table->foreign('SaleID')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('ProductID')->references('id')->on('products')->onDelete('cascade');
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
