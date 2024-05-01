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
        Schema::create('entity_payment_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('EntityID');
            $table->string('PaymentMethod', 100);
            $table->string('AccountName', 100)->nullable();
            $table->string('AccountNumber', 50)->nullable();
            $table->string('BankName', 100)->nullable();
            $table->string('Branch', 100)->nullable();
            // $table->timestamps();

            // Foreign key constraint
            $table->foreign('EntityID')->references('id')->on('entities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_payment_infos');
    }
};
