<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        // Product name
        'ProductName',
        // Product barcode
        'Barcode',
        // Product generic name
        'GenericName',
        // Product drug class
        'DrugClass',
        // Product brand names
        'BrandNames',
        // Expiry date
        'ExpiryDate',
        // Chemical structure
        'ChemicalStructure',
        // Pharmacological class
        'PharmacologicalClass',
        // Indications and usage
        'IndicationsAndUsage',
        // Dosage information
        'DosageInformation',
        // Mechanism of action
        'MechanismOfAction',
        // Pharmacokinetics
        'Pharmacokinetics',
        // Contraindications
        'Contraindications',
        // Adverse effects
        'AdverseEffects',
        // Warnings and precautions
        'WarningsAndPrecautions',
        // Clinical trials
        'ClinicalTrials',
        // Regulatory information
        'RegulatoryInformation',
        // Storage and handling
        'StorageAndHandling',
        // Overdose and treatment
        'OverdoseAndTreatment',
        // Patient information
        'PatientInformation',
        // Cost and availability
        'CostAndAvailability',
        // Text references
        'TextReferences',
        // Vendor ID
        'VendorID',
        // Product price
        'Price',
        // Product quantity
        'Quantity',
        // User ID who added the product
        'AddedBy',
        // Timestamp when the product was added
        'AddedOn',
        // User ID who approved edit
        'ApprovedBy',
        // Timestamp when edit was approved
        'ApprovedOn',
        // Entity ID
        'Type',
        'Insured',

        'entity_id',
        // Department ID
        'department_id',
        // User ID who approved edit
        'edit_approved_by',
        // Timestamp when edit was approved
        'edit_approved_at',
        // Product serial number
        'serial_number',
        // expiry date as dateTime
        'expiry_date',
    ];

    // belongs to entity
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
