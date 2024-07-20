<?php

namespace App\Filament\Imports;

use App\Models\Product;
use App\Models\Department;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('ProductName')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('Type')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('Insured')
                ->requiredMapping()
                ->rules(['required', 'string'])
                ->castStateUsing(function (string $state): int {
                    return strtolower($state) === 'yes' ? 1 : 0;
                }),
            ImportColumn::make('Price')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            // ImportColumn::make('department_id')
            //     ->label('Service Point')
            //     ->requiredMapping()
            //     ->rules(['required', 'string'])
            //     ->fillRecordUsing(function (Product $record, string $state): void {
            //         $department = Department::firstOrCreate(['name' => $state]);
            //         $record->department_id = $department->id;
            //     }),
        ];
    }

    // public function resolveRecord(): ?Product
    // {
    //     return new Product();
    // }

    // protected function beforeValidate(): void
    // {
    //     Log::info('Before Validate', ['data' => $this->data]);
    // }

    // protected function afterValidate(): void
    // {
    //     Log::info('After Validate', ['data' => $this->data, 'errors' => $this->errors()]);
    // }

    // protected function beforeFill(): void
    // {
    //     Log::info('Before Fill', ['data' => $this->data]);
    // }

    // protected function afterFill(): void
    // {
    //     Log::info('After Fill', ['record' => $this->record->toArray()]);
    // }

    // protected function beforeSave(): void
    // {
    //     try {
    //         // Generate a unique serial number
    //         $this->record->serial_number = $this->generateUniqueSerialNumber();

    //         // Assign additional fields
    //         $this->record->entity_id = Auth::user()->entity_id;
    //         $this->record->AddedBy = Auth::user()->id;
    //         $this->record->status = 1;

    //         Log::info('Before Save', ['record' => $this->record->toArray()]);

    //     } catch (\Exception $e) {
    //         Log::error('Error in beforeSave method: ' . $e->getMessage(), [
    //             'record' => $this->record,
    //             'user' => Auth::user(),
    //         ]);
    //         throw $e;
    //     }
    // }

    // protected function afterSave(): void
    // {
    //     if (!$this->record->exists) {
    //         Log::error('Record did not save', ['record' => $this->record->toArray()]);
    //     } else {
    //         Log::info('After Save', ['record' => $this->record->toArray()]);
    //     }
    // }

    // private function generateUniqueSerialNumber(): string
    // {
    //     do {
    //         $serialNumber = mt_rand(10000000, 99999999);
    //     } while (Product::where('serial_number', $serialNumber)->exists());

    //     return $serialNumber;
    // }

    // public static function getCompletedNotificationBody(Import $import): string
    // {
    //     $body = 'Your product import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

    //     if ($failedRowsCount = $import->getFailedRowsCount()) {
    //         $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
    //     }

    //     Log::info($body);
    //     return $body;
    // }


    
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
