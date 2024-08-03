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
        Schema::table('salesitems', function (Blueprint $table) {
            $table->boolean('Partial')->default(false); // Add the 'partial' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salesitems', function (Blueprint $table) {
            $table->dropColumn('Partial'); // Remove the 'partial' column
        });
    }
};
