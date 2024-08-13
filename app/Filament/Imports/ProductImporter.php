<?php

namespace App\Filament\Imports;

use App\Models\Product;
use App\Models\Department;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('ProductName')
                ->label('Item Name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
           
            ImportColumn::make('Price')
                ->label('Item Price')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
           
            ImportColumn::make('entity_id')
                ->label('Business ID')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            
            ImportColumn::make('serial_number')
                ->label('Serial Number')
                ->requiredMapping(),
                // ->rules(['required', 'max:255']),
            
            ImportColumn::make('service_point_id')
                ->label('Service Point Number')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    protected function beforeSave(): void
    {
        // Validate service_point_id and store it temporarily
        $servicePointId = $this->data['service_point_id'];
        $department = Department::find($servicePointId);

        if (!$department) {
            throw new RowImportFailedException("No department found with ID [{$servicePointId}].");
        }

        $this->validatedServicePointId = $servicePointId;
    }

    public function resolveRecord(): ?Product
    {
        // Process each product individually
        $product = new Product();

        // Set product fields from the CSV data
        $product->ProductName = $this->data['ProductName'];
        $product->Price = $this->data['Price'];
        $product->entity_id = $this->data['entity_id'];
        $product->serial_number = $this->data['serial_number'];

        // Save the product
        $product->save();

        return $product;
    }

    protected function afterSave(): void
    {
        // Attach the validated service_point_id to the product
        $this->record->departments()->attach($this->validatedServicePointId);
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
