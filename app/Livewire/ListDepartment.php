<?php

namespace App\Livewire;

use App\Models\Department;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;

class ListDepartment extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {

        if (auth()->user()->role_id == 1) {

            return $table

                ->query(
                    Department::query()


                )
                ->columns([
                    Tables\Columns\TextColumn::make('id')
                    ->label('Service Point ID')
                    ->sortable()
                    ->searchable(),
                    Tables\Columns\TextColumn::make('name')
                        ->label('Service Point Name')
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('code')
                        ->label('Room Number')
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('entity.EntityName')
                        ->label('Business Name')
                        ->searchable()
                        ->numeric()
                        ->sortable(),
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
                    Action::make('edit')
                        ->label('Edit')
                        ->color('warning')
                        ->icon('heroicon-o-pencil')
                        ->url(function ($record) {
                            // Return the URL for the clicked record
                            // return view('livewire.edit-department', ['id' => $record->id]);
                            return route('departments.edit', $record->id);
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


                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        //
                    ]),
                ]);
        }

        else {
            return $table

            ->query(
                Department::query()
                    ->where('entity_id', auth()->user()->entity_id)
                    // ->where('department_id', auth()->user()->department_id)
                    // ->orderBy('created_at', 'desc')
               


            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('Service Point ID')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Service Point Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Service Point Code')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('entity.EntityName')
                    ->label('Pharmacy Name')
                    ->searchable()
                    ->numeric()
                    ->sortable(),
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
        return view('livewire.list-department');
    }
}
