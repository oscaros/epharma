<?php

namespace App\Livewire;

use App\Models\Sale;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use App\Payments\YoAPI;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Log;

class ListPendingClients extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function mount()
    {
        $this->checkAndUpdateTransactionStatus();
    }

    protected function checkAndUpdateTransactionStatus()
    {
        $sales = Sale::where('status', 'Pending')->get(); // Fetch pending transactions

        foreach ($sales as $sale) {
            try {
                $yoAPI = new YoAPI('100589248779', 'bVXo-BDBw-KF5x-JSAS-9tm0-jORW-rYqX-7EGn');
                $statusCheck = $yoAPI->ac_transaction_check_status($sale->reference);

                // Only update the status if a valid TransactionStatus is returned
                if (isset($statusCheck['TransactionStatus']) && !empty($statusCheck['TransactionStatus'])) {
                    $sale->update(['status' => $statusCheck['TransactionStatus']]);
                    Log::info("Updated status for Sale ID {$sale->id} to {$statusCheck['TransactionStatus']}");
                } else {
                    // Log the issue and skip the update
                    Log::warning("No valid TransactionStatus for Sale ID {$sale->id}. Response: ", $statusCheck);
                }
            } catch (\Exception $e) {
                Log::error("Error checking transaction status for Sale ID {$sale->id}: " . $e->getMessage());
            }
        }
    }

    public function table(Table $table): Table
    {
        $query = Sale::query()
            ->whereHas('saleItems', function (Builder $query) {
                $query->where('Status', 0) // Only include sales with sale items that have Status 0
                    ->whereHas('product', function (Builder $query) {
                        $query->where('service_point_id', auth()->user()->department_id); // Filter by service_point_id
                    });
            })
            ->orderBy('updated_at', 'desc'); // Order by updated_at descending

        if (auth()->user()->role_id == 1) {
            return $table
                ->query($query)
                ->columns([
                    Tables\Columns\TextColumn::make('customers.FirstName')
                        ->label('First Name')
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('customers.LastName')
                        ->label('Last Name')
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('phone_number')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('amount')
                        ->numeric()
                        ->url(fn($record) => route('sale-items.index', ['sale_id' => $record->id]))
                        ->sortable(),
                    Tables\Columns\TextColumn::make('payment_method')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('status')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ])
                ->filters([
                    // Add any filters here
                ])
                ->actions([
                    Action::make('view')
                        ->label('View Details')
                        ->color('primary')
                        ->icon('heroicon-o-eye')
                        ->url(fn($record) => route('sale-items.index', ['sale_id' => $record->id]))
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        // Add bulk actions here
                    ]),
                ]);
        } else {
            return $table
            
                ->query($query->where('entity_id', auth()->user()->entity_id))
                ->columns([
                    Tables\Columns\TextColumn::make('customers.FirstName')
                        ->label('First Name')
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('customers.LastName')
                        ->label('Last Name')
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('phone_number')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('amount')
                        ->numeric()
                        ->url(fn($record) => route('sale-items.index', ['sale_id' => $record->id]))
                        ->sortable(),
                    Tables\Columns\TextColumn::make('payment_method')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('status')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ])
                ->filters([
                    // Add any filters here
                ])
                ->actions([
                    Action::make('view')
                        ->label('View Details')
                        ->color('primary')
                        ->icon('heroicon-o-eye')
                        ->url(fn($record) => route('sale-items.index', ['sale_id' => $record->id]))
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        // Add bulk actions here
                    ]),
                ]);
        }
    }

    public function render(): View
    {
        return view('livewire.list-pending-clients');
    }
}
