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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            // Product IDs as an array of many products made in one sale
            $table->json('product_id');
            // Sales total amount
            $table->decimal('amount', 10, 2); // Assuming 10 digits in total with 2 decimal places
            // User ID who made the sale
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('entity_id')->constrained('entities')->onDelete('cascade');
        


         
            $table->string('type');
            // $table->string('amount');
            $table->string('phone_number');
            $table->string("payment_mode");
            $table->string("payment_method")->nullable();
            $table->text('description')->nullable;
            $table->string('reference');
            $table->string('status');
            $table->string("order_tracking_id")->nullable();
            $table->string("OrderNotificationType")->nullable();
      
            $table->softDeletes();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
