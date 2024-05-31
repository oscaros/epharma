<?php

namespace App\Livewire;

use App\Filament\Exports\AdvanceExporter;
use App\Filament\Imports\ProductImporter;
use App\Models\Product;
use App\Models\ProductTemp;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Livewire\Component;

class ListProductTemp extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        if (auth()->user()->role_id == 1) {
            return $table
                ->query(
                    ProductTemp::query()
                )
                ->columns([
                    Tables\Columns\TextColumn::make('ProductName')
                        ->searchable()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('Price')
                        ->money('UGX')
                        ->searchable()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('Quantity')
                        ->numeric()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('NewQuantity')
                        ->numeric()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('serial_number')
                        ->searchable()
                        ->copyable()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('expiry_date')
                        ->dateTime()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('status')
                        ->searchable()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
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
                                    fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                                )
                                ->when(
                                    $data['created_until'],
                                    fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
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
                ->headerActions([
                    ExportAction::make()
                        ->exporter(AdvanceExporter::class),
                    ImportAction::make()
                        ->importer(ProductImporter::class)
                ])
                ->actions([
                    // action view
                    Action::make('view')
                        ->label('View')
                        ->color('primary')
                        ->icon('heroicon-o-eye')
                        ->url(function ($record) {
                            // Return the URL for the clicked record
                            return route('products.show', $record->id);
                        }),
                    Action::make('edit')
                        ->label('Edit')
                        ->color('warning')
                        ->icon('heroicon-o-pencil')
                        ->url(function ($record) {
                            // Return the URL for the clicked record
                            return route('products.edit', $record->id);
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
        } else {
            return $table
                ->query(
                    ProductTemp::query()
                        ->where('entity_id', auth()->user()->entity_id)
                )
                ->columns([
                    Tables\Columns\TextColumn::make('ProductName')
                        ->searchable()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('Price')
                        ->money('UGX')
                        ->searchable()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('Quantity')
                        ->numeric()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('serial_number')
                        ->searchable()
                        ->copyable()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('expiry_date')
                        ->dateTime()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: false),
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->copyable()
                        ->toggleable(isToggledHiddenByDefault: true),
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
                                    fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                                )
                                ->when(
                                    $data['created_until'],
                                    fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
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
                ->headerActions([
                    ExportAction::make()
                        ->exporter(AdvanceExporter::class),
                    ImportAction::make()
                        ->importer(ProductImporter::class)
                ])
                ->actions([
                    Action::make('sale')
                        ->label('Add to Cart')
                        ->color('primary')
                        ->icon('heroicon-o-shopping-cart')
                        ->url(function ($record) {
                            // Return the URL for the clicked record
                            return route('sales.show', $record->id);
                        }),
                    Action::make('edit')
                        ->label('Edit')
                        ->color('warning')
                        ->icon('heroicon-o-pencil')
                        ->url(function ($record) {
                            // Return the URL for the clicked record
                            return route('products.edit', $record->id);
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
    }

    public function render(): View
    {
        return view('livewire.list-product-temp');
    }
}
