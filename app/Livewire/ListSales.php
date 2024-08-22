<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
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

    public $customer_id;

    public function mount($customer_id = null)
    {
        $this->customer_id = $customer_id;
    }

    public function table(Table $table): Table
    {
        $user = auth()->user();
        $departmentId = $user->department_id;

        $query = Sale::query();

        // Apply filters based on role
        if ($user->role_id != 1) { // Non-admin users
            $query->where('entity_id', $user->entity_id)
                ->where('user_id', $user->id)
                ->where('status', 'SUCCEEDED')
                ->where(function ($query) use ($departmentId) {
                    $query->whereHas('products', function (Builder $query) use ($departmentId) {
                        $query->whereIn('id', function ($subQuery) use ($departmentId) {
                            $subQuery->select('id')
                                ->from('products')
                                ->where('service_point_id', $departmentId);
                        });
                    });
                });
        }

        // Apply customer filtering if needed
        if ($this->customer_id) {
            $query->where('customer_id', $this->customer_id);
        }

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('customers.FirstName')
                    ->sortable()
                    ->label('Client Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('type')
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
    }

    public function render(): View
    {
        return view('livewire.list-sales');
    }
}
