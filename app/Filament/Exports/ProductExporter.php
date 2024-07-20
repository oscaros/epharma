<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            // ExportColumn::make('id')
            //     ->label('ID'),
            ExportColumn::make('ProductName')
                ->label('Item Name'),
            // ExportColumn::make('Type'),
            // ExportColumn::make('Status'),
            // ExportColumn::make('Insured'),
            // ExportColumn::make('qr_code'),
            // ExportColumn::make('GenericName'),
            // ExportColumn::make('DrugClass'),
            // ExportColumn::make('BrandNames'),
            // ExportColumn::make('ExpiryDate'),
            // ExportColumn::make('ChemicalStructure'),
            // ExportColumn::make('PharmacologicalClass'),
            // ExportColumn::make('IndicationsAndUsage'),
            // ExportColumn::make('DosageInformation'),
            // ExportColumn::make('MechanismOfAction'),
            // ExportColumn::make('Pharmacokinetics'),
            // ExportColumn::make('Contraindications'),
            // ExportColumn::make('AdverseEffects'),
            // ExportColumn::make('WarningsAndPrecautions'),
            // ExportColumn::make('ClinicalTrials'),
            // ExportColumn::make('RegulatoryInformation'),
            // ExportColumn::make('StorageAndHandling'),
            // ExportColumn::make('OverdoseAndTreatment'),
            // ExportColumn::make('PatientInformation'),
            // ExportColumn::make('CostAndAvailability'),
            // ExportColumn::make('TextReferences'),
            // ExportColumn::make('VendorID'),
            ExportColumn::make('Price'),
            // ExportColumn::make('Quantity'),
            // ExportColumn::make('AddedBy'),
            // ExportColumn::make('ApprovedBy'),
            // ExportColumn::make('ApprovedOn'),
            // ExportColumn::make('entity_id'),
            // ExportColumn::make('EditApprovedOn'),
            ExportColumn::make('serial_number'),
            // ExportColumn::make('expiry_date'),
            // ExportColumn::make('created_at'),
            // ExportColumn::make('updated_at'),
            // ExportColumn::make('department_id'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your item export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
