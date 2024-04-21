<?php

namespace App\Livewire;

use App\Models\Sale;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListSales extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        if (auth()->user()->role_id == 1) {
            return $table
                ->query(Sale::query())
                ->columns([
                    // return product name from products table based on product id in sales table
                    Tables\Columns\TextColumn::make('product_id')
                        ->searchable()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('amount')
                        ->money('UGX')
                        ->searchable()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                ])
                ->filters([
                    //
                ])
                ->actions([
                    //
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        //
                    ]),
                ]);
        } else {
            return $table
                ->query(Sale::query()
                    ->where('user_id', auth()->user()->id)
                    )
                ->columns([
                    //
                ])
                ->filters([
                    //
                ])
                ->actions([
                    //
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        //
                    ]),
                ]);
        }
    }

    public function render(): View
    {
        return view('livewire.list-sales');
    }
}
