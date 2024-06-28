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
use Filament\Tables\Actions\Action;

class ListCustomerSales extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Sale::query())
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('user_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('entity_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('type')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('payment_mode')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('order_tracking_id')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('OrderNotificationType')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('deleted_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                //fetch customer name from customers table
                
                Tables\Columns\TextColumn::make('customers.FirstName')
                    ->label('Patient Name')
                    ->sortable()
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
                //
            ])
            ->actions([
                //
                Action::make('view')
                ->label('View Details')
                ->color('primary')
                ->icon('heroicon-o-eye')
                ->url(function ($record) {
                    // Return the URL for the clicked record
                    //return record
                    $sale = Sale::find($record->id);

                    // dd($sale);

                    return route('sale-items.index', $sale->customer_id);
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.list-customer-sales');
    }
}
