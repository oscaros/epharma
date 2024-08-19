<?php

namespace App\Livewire;

use App\Models\SaleItem;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListSaleItems extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $customer_id;
    public $sale_id;

    public function mount($customer_id = null, $sale_id = null)
    {
        $this->customer_id = $customer_id;
        $this->sale_id = $sale_id;
    }

    protected $listeners = ['setCustomerId' => 'updateCustomerId'];

    public function updateCustomerId($customerId)
    {
        $this->customer_id = $customerId;
        $this->render();  // Force a render to update the table
    }

    



protected function getTableQuery(): Builder
{
    $query = SaleItem::query();

    if ($this->sale_id) {
        $query->where('SaleID', $this->sale_id);
    }

    if ($this->customer_id) {
        $query->whereHas('sale', function (Builder $query) {
            $query->where('customer_id', $this->customer_id);
        });
    }

    return $query;
}


    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                Tables\Columns\TextColumn::make('product.ProductName')
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
                    ->label('Fully Offered?')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: false),
                CheckboxColumn::make('Partial')
                    ->label('Partially Offered?')
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
            'table' => $this->table(new Table($this)),
        ]);
    }
}
