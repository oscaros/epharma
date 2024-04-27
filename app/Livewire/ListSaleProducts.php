<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Sale;
use App\Tables\Columns\InputColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;

class ListSaleProducts extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $grandTotal = 0;
    public $cart = [];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                // ->where('entity_id', auth()->user()->entity_id)
                //todo: add query to get products with quantity greater than 0
                //todo: add query to get products with expiry date greater than today

            )
            ->columns([
                Tables\Columns\TextColumn::make('ProductName')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Price')
                    ->money("UGX")
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Quantity')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('serial_number')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('expiry_date')
                //     ->date()
                //     ->sortable(),
                //add field to manually enter quantity of product to sell

                InputColumn::make('Quantity to Sell')
                    ->label('Quantity to Sell')
            ])
            ->filters([
                //
            ])
            ->actions([
                // Action::make('edit')
                //     ->label('Edit')
                //     ->color('warning')
                //     ->icon('heroicon-o-pencil')
                //     ->url(function ($record) {
                //         // Return the URL for the clicked record
                //         return route('products.edit', $record->id);
                //     }),

                // Action::make('delete')
                //     ->label('Delete')
                //     ->requiresConfirmation()
                //     ->color('danger')
                //     ->icon('heroicon-o-trash')
                //     ->action(function ($record) {
                //         // Delete the record
                //         if ($record->delete()) {
                //             Notification::make()
                //                 ->title('Delete record ' . $record->id . ' successfully')
                //                 ->success()
                //                 ->send();
                //         }
                //     }),
                // Add action to save the grand total
                Action::make('save')
                    ->label('Confirm Sale')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')                 
                    ->requiresConfirmation()
                    ->action(function () {
                        $this->saveGrandTotal();
                    })
                    ->fillForm(fn(Product $record): array => [
                        'ProductName' => $record->ProductName,
                        'Quantity' => $record->Quantity,
                        'Price' => $record->Price,
                        'serial_number' => $record->serial_number,
                        'expiry_date' => $record->expiry_date,
                    ])
                    ->form([
                        TextInput::make('ProductName')
                            ->label('Product Name')
                            ->default(function (Product $record) {
                                return $record->ProductName;
                            })
                            ->required(),

                        TextInput::make('Quantity')
                            ->label('Available Stock')
                            //put field data of selected product in the form
                            ->default(function (Product $record) {
                                return $record->Quantity;
                            })
                            ->required(),

                        TextInput::make('Price')
                            ->default(function (Product $record) {
                                return $record->Price;
                            })
                            ->label('Price')
                            ->required(),

                        TextInput::make('serial_number')
                            ->default(function (Product $record) {
                                return $record->serial_number;
                            })
                            ->label('Serial Number')
                            ->required(),

                        TextInput::make('expiry_date')
                            ->default(function (Product $record) {
                                return $record->expiry_date;
                            })
                            ->label('Expiry Date')
                            ->required(),
                        // Add a field for the quantity to be sold
                       
                    ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([])
            ]);
    }

    public function render(): View
    {
        return view('livewire.list-sale-products', [
            'grandTotal' => $this->grandTotal,
        ]);
    }

    public function saveGrandTotal()

    {

        dd($this->grandTotal);
        // Save the grand total to the database
        // For example, you can save it in a 'sales' table
        Sale::create([
            // 'product_id' => json_encode(array_keys($this->cart)),
            'product_id' => json_encode(array_values([1, 2])),
            'amount' => $this->grandTotal,
            'user_id' => auth()->id(),
            'entity_id' => auth()->user()->entity_id
        ]);

        session()->flash('message', 'Grand Total has been saved successfully!');
    }

    public function updatedCart($productId, $quantity)
    {
        if ($quantity <= 0) {
            unset($this->cart[$productId]);
        } else {
            $this->cart[$productId] = $quantity;
        }
        $this->updateGrandTotal();
    }

    public function updateCart($productId)
    {
        $this->updatedCart($productId, $this->cart[$productId]);
    }

    public function updateGrandTotal()
    {
        $this->grandTotal = collect($this->cart)->sum();
    }
}

