<?php

namespace App\Livewire;

use App\Models\SaleItem;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListSaleItems extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $customer_id; // Add property to store customer_id

    public function mount($customer_id = null)
    {
        $this->customer_id = $customer_id;
    }

    public function table(Table $table): Table
    {
        $query = SaleItem::query()
        ->whereHas('sale', function (Builder $query) {
            if ($this->customer_id) {
                $query->where('customer_id', $this->customer_id);
            }
        });

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('products.ProductName')
                    ->label('Medicine Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Price')
                    ->label('Price(UGX)')
                    ->numeric()
                    ->sortable(),
                CheckboxColumn::make('Status')
                    ->label('Offered?')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: false),
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
                // Add filters if needed
            ])
            ->actions([
                // Add actions if needed
            ])
            ->bulkActions([
                // Add bulk actions if needed
            ]);
    }

    public function render(): View
    {
        return view('livewire.list-sale-items', [
            'table' => $this->table(new Table($this )),
        ]);
    }
}
