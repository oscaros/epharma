<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;

use Filament\Tables\Filters\Layout;


class ListUsers extends Component implements HasForms, HasTable, HasActions
{
    use InteractsWithTable;
    use InteractsWithForms;
    use InteractsWithActions;


    // protected function getTableFiltersLayout(): ?string
    // {
    //     return Layout::AboveContent;
    // }



    public function table(Table $table): Table
    {

        return $table
            ->query(
                User::query()
                    // ->orWhereNot("email", "superadmin@coffeeims.com")
                    ->where('entity_id', auth()->user()->entity_id)
                    
            )
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->label('Name'),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->label('Email'),
                TextColumn::make('role.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->copyable()
                    ->label('Role'),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('From'),
                        DatePicker::make('created_until')
                            ->label('To'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['from'] ?? null) {
                            $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['from'])->toFormattedDateString())
                                ->removeField('from');
                        }

                        if ($data['until'] ?? null) {
                            $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['until'])->toFormattedDateString())
                                ->removeField('until');
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                // ...
                Action::make('edit')
                    ->label('Edit')
                    ->color('warning')
                    ->icon('heroicon-o-pencil')
                    ->url(function ($record) {
                        // Return the URL for the clicked record
                        return route('users.edit', $record->id);
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
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.list-users');
    }
}
