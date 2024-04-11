<?php

namespace App\Livewire;

use App\Models\Entity;
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

class ListEntities extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Entity::query())
            ->where('entity_id', auth()->user()->entity_id)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.list-entities');
    }
}
