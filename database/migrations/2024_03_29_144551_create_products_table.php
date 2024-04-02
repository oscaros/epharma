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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Product name
            $table->string('name');
            // Product price
            $table->decimal('price', 10, 2); // Assuming 10 digits in total with 2 decimal places
            // Product quantity
            $table->integer('quantity');
            // Product serial number (auto-generated random number)
            $table->string('serial_number')->unique(); // Assuming serial number should be unique
            //entity_id foreign key references entities table
            $table->foreignId('entity_id')->constrained();

            

            // Expiry date
            $table->date('expiry_date')->nullable();
            // User ID who approved edit
            $table->unsignedBigInteger('edit_approved_by')->nullable();
            // Timestamp when edit was approved
            $table->timestamp('edit_approved_at')->nullable();
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('edit_approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};