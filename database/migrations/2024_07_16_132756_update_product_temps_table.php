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
         // Adding department_id foreign key to product_temps
         Schema::table('product_temps', function (Blueprint $table) {
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
        });

        // Adding Insured enum field to product_temps
        Schema::table('product_temps', function (Blueprint $table) {
            $table->enum('Insured', ['0', '1'])->default('0')->after('Status');
        });

        // Changing Status to 0 for existing records in product_temps
        DB::table('product_temps')->update(['Status' => '0']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_temps', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
            $table->dropColumn('Insured');
        });
    }
};
