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
            $table->integer('new_status')->default(0);
        });

        // Step 2: Update existing data
        DB::table('salesitems')->update(['new_status' => DB::raw("CASE Status WHEN 'active' THEN 1 WHEN 'inactive' THEN 0 ELSE 0 END")]);

        // Step 3: Drop the old column and rename the new column
        Schema::table('salesitems', function (Blueprint $table) {
            $table->dropColumn('Status');
            $table->renameColumn('new_status', 'Status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Step 1: Add the old ENUM column back
         Schema::table('salesitems', function (Blueprint $table) {
            $table->enum('old_status', ['active', 'inactive'])->default('inactive');
        });

        // Step 2: Update the data back to ENUM values
        DB::table('salesitems')->update(['old_status' => DB::raw("CASE Status WHEN 1 THEN 'active' WHEN 0 THEN 'inactive' ELSE 'inactive' END")]);

        // Step 3: Drop the new column and rename the old column back
        Schema::table('salesitems', function (Blueprint $table) {
            $table->dropColumn('Status');
            $table->renameColumn('old_status', 'Status');
        });
    }
};
