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
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('service_point_id')->nullable()->after('entity_id');
            
            // If you want to add a foreign key constraint
            // $table->foreign('service_point_id')->references('id')->on('service_points')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('service_point_id');
            
            // If you added a foreign key constraint, drop it here
            // $table->dropForeign(['service_point_id']);
        });
    }
};
