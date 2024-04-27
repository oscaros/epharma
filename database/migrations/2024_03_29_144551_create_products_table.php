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
            $table->string('ProductName');
            // Product barcode
            $table->string('Barcode')->nullable();
            // Product generic name
            $table->string('GenericName')->nullable();
            // Product brand names (assuming multiple brands can be associated with a product)
            $table->text('BrandNames')->nullable();
            // Expiry date
            $table->date('ExpiryDate')->nullable();
            // Chemical structure
            $table->text('ChemicalStructure')->nullable();
            // Pharmacological class
            $table->text('PharmacologicalClass')->nullable();
            // Indications and usage
            $table->text('IndicationsAndUsage')->nullable();
            // Dosage information
            $table->text('DosageInformation')->nullable();
            // Mechanism of action
            $table->text('MechanismOfAction')->nullable();
            // Pharmacokinetics
            $table->text('Pharmacokinetics')->nullable();
            // Contraindications
            $table->text('Contraindications')->nullable();
            // Adverse effects
            $table->text('AdverseEffects')->nullable();
            // Warnings and precautions
            $table->text('WarningsAndPrecautions')->nullable();
            // Clinical trials
            $table->text('ClinicalTrials')->nullable();
            // Regulatory information
            $table->text('RegulatoryInformation')->nullable();
            // Storage and handling
            $table->text('StorageAndHandling')->nullable();
            // Overdose and treatment
            $table->text('OverdoseAndTreatment')->nullable();
            // Patient information
            $table->text('PatientInformation')->nullable();
            // Cost and availability
            $table->text('CostAndAvailability')->nullable();
            // Text references
            $table->text('TextReferences')->nullable();
            // Vendor ID
            $table->unsignedBigInteger('VendorID')->nullable();
            // Product price
            $table->decimal('Price', 10, 2);
            // Product quantity
            $table->integer('Quantity');
            // User ID who added the product
            $table->unsignedBigInteger('AddedBy')->nullable();
            // Timestamp when the product was added
            // $table->timestamp('AddedOn')->default(DB::raw('CURRENT_TIMESTAMP'));
            // User ID who approved edit
            $table->unsignedBigInteger('ApprovedBy')->nullable();
            // Timestamp when edit was approved
            $table->timestamp('ApprovedOn')->nullable();
            // Entity ID foreign key references entities table
            $table->foreignId('entity_id')->constrained();
            
            // Foreign key constraint for edit approval
            // $table->foreign('edit_approved_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamp('EditApprovedOn')->nullable();
            // Foreign key constraint for vendor ID
            $table->foreign('VendorID')->references('id')->on('vendors')->onDelete('cascade');
            // Foreign key constraint for added by user ID
            $table->foreign('AddedBy')->references('id')->on('users')->onDelete('cascade');
            // Foreign key constraint for approved by user ID
            $table->foreign('ApprovedBy')->references('id')->on('users')->onDelete('cascade');
            // Product serial number (auto-generated random number)
            $table->string('serial_number')->unique(); // Assuming serial number should be unique
          

            // Expiry date
            $table->date('expiry_date')->nullable();
          
            //add timestamps
            $table->timestamps();
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
