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
        Schema::create('ipn_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('date_time');
            $table->decimal('amount', 15, 2);
            $table->string('narrative');
            $table->string('network_ref')->unique();
            $table->string('external_ref');
            $table->string('msisdn');
            $table->string('payer_names');
            $table->string('payer_email');
            $table->string('signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_p_n_transactions');
    }
};
