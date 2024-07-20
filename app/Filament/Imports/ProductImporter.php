<?php

namespace App\Filament\Imports;

use App\Models\Product;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('ProductName')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            // ImportColumn::make('Type')
            //     ->requiredMapping()
            //     ->rules(['required']),
            // ImportColumn::make('Status')
            //     ->requiredMapping()
            //     ->rules(['required']),
            // ImportColumn::make('Insured')
            //     ->requiredMapping()
            //     ->rules(['required']),
            // ImportColumn::make('qr_code'),
            // ImportColumn::make('GenericName')
            //     ->rules(['max:255']),
            // ImportColumn::make('DrugClass')
            //     ->rules(['max:255']),
            // ImportColumn::make('BrandNames'),
            // ImportColumn::make('ExpiryDate')
            //     ->rules(['date']),
            // ImportColumn::make('ChemicalStructure'),
            // ImportColumn::make('PharmacologicalClass'),
            // ImportColumn::make('IndicationsAndUsage'),
            // ImportColumn::make('DosageInformation'),
            // ImportColumn::make('MechanismOfAction'),
            // ImportColumn::make('Pharmacokinetics'),
            // ImportColumn::make('Contraindications'),
            // ImportColumn::make('AdverseEffects'),
            // ImportColumn::make('WarningsAndPrecautions'),
            // ImportColumn::make('ClinicalTrials'),
            // ImportColumn::make('RegulatoryInformation'),
            // ImportColumn::make('StorageAndHandling'),
            // ImportColumn::make('OverdoseAndTreatment'),
            // ImportColumn::make('PatientInformation'),
            // ImportColumn::make('CostAndAvailability'),
            // ImportColumn::make('TextReferences'),
            // ImportColumn::make('VendorID')
            //     ->numeric()
            //     ->rules(['integer']),
            ImportColumn::make('Price')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            // ImportColumn::make('Quantity')
            //     ->numeric()
            //     ->rules(['integer']),
            // ImportColumn::make('AddedBy')
            //     ->numeric()
            //     ->rules(['integer']),
            // ImportColumn::make('ApprovedBy')
            //     ->numeric()
            //     ->rules(['integer']),
            // ImportColumn::make('ApprovedOn')
            //     ->rules(['datetime']),
            ImportColumn::make('entity_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            // ImportColumn::make('EditApprovedOn')
            //     ->rules(['datetime']),
            ImportColumn::make('serial_number')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            // ImportColumn::make('expiry_date')
            //     ->rules(['date']),
            ImportColumn::make('department_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): ?Product
    {
        // return Product::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Product();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your product import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
