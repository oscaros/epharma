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
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
           
            $table->string('EntityName', 255);
            $table->string('Email', 255)->nullable();
            $table->string('Phone', 255)->nullable();
            $table->string('Address', 255)->nullable();
   
          
            // $table->foreign('CreatedBy')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('UpdatedBy')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
