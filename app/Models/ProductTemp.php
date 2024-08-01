<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        //product name
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
        //new quantity
        'NewQuantity',
        //status
        'status',
        // User ID who added the product
        'AddedBy',
        // Timestamp when the product was added
        'AddedOn',
        // User ID who approved edit
        'ApprovedBy',
        // Timestamp when edit was approved
        'ApprovedOn',
        // Entity ID
        'entity_id',
        // User ID who approved edit
        'edit_approved_by',
        // Timestamp when edit was approved
        'edit_approved_at',
        // Product serial number
        'serial_number',
        // expiry date as dateTime
        'expiry_date',
        //department
        'department_id',
        'Insured',
    
        
    ];


    public function approve ()
    {
        $this->Status = '1';
        $this->ApprovedBy = auth()->id();
        $this->ApprovedOn = Carbon::now();
        //update record in products table as well

        


        $this->save();
        //retrieve saved record

        $product = ProductTemp::where('serial_number', $this->serial_number)->first();
        $data = [
            'ProductName' => $product->ProductName,
            'Price' => $product->Price,
            'Quantity' => $product->Quantity,
            'serial_number' => $product->serial_number,
            'entity_id' => auth()->user()->entity_id,
            'AddedBy' => auth()->id(),
            // 'AddedOn' => Carbon::now(),
            'ApprovedBy' => auth()->id(),
            'ApprovedOn' => Carbon::now(),
            'status' => '1',
            
            'Insured' => $product->Insured,

        ];
        //update or create record in product
        Product::updateOrCreate(['id' => $product->id], $data);


    }

    public function reject ()
    {
        $this->Status = '0';
        $this->save();
    }
}
