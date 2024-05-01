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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName', 50);
            $table->string('LastName', 50);
            $table->string('Email', 100)->unique()->nullable();
            $table->string('Phone', 20)->nullable();
            $table->string('Address', 255)->nullable();
            //add NIN national id number 13 characters
            $table->string('NIN', 14)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
