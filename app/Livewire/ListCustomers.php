<?php

namespace App\Livewire;

use App\Models\Customer;
use Filament\Tables\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListCustomers extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Customer::query())
            ->columns([
                Tables\Columns\TextColumn::make('FirstName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('LastName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('PType')
                    ->label('Patient Type')
                    ->searchable(),
                    CheckboxColumn::make('PInsured')
                    ->label('Is Insured?')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Address')
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
                //edit and delete actions
                Action::make('edit')
                    ->label('Edit')
                    ->color('warning')
                    ->icon('heroicon-o-pencil')
                    ->url(function ($record) {
                        // Return the URL for the clicked record
                        return route('entities.edit', $record->id);
                    }),
                Action::make('delete')
                    ->label('Delete')
                    ->requiresConfirmation()
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->action(function ($record) {
                        // Delete the record
                        if ($record->delete()) {
                            Notification::make()
                                ->title('Delete record ' . $record->id . ' successfully')
                                ->success()
                                ->send();
                        }
                    }),
                    //add action to show details
                Action::make('details')
                    ->label('Details')
                    ->color('info')
                    ->icon('heroicon-o-eye')
                    ->url(function ($record) {
                        // Return the URL for the clicked record
                        return route('entities.show', $record->id);
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
        return view('livewire.list-customers');
    }
}
