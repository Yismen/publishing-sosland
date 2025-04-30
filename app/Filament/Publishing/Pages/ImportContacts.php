<?php

namespace App\Filament\Publishing\Pages;

use App\Models\Contact;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Cache;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use App\Filament\Exports\ContactExporter;
use App\Filament\Imports\ContactImporter;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class ImportContacts extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.import-contacts';

    public function table(Table $table): Table
    {
        return $table
            ->poll('25s')
            ->deferLoading()
            ->query(Contact::query())
            ->columns([
                TextColumn::make('date')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('first_name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('last_name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->copyable()
                    ->searchable()
                    ->limit(15)
                    ->tooltip(fn($state) => $state),
                TextColumn::make('campaign')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('disposition')
                    ->limit(15)
                    ->tooltip(fn($state) => $state)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email_sent_at')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('updated_at')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                TernaryFilter::make('email_sent_at')
                    ->label('Email Sent')
                    ->placeholder('Select a date range')
                    ->placeholder('Email Sent'),
                SelectFilter::make('disposition')
                    ->label('Disposition')
                    ->placeholder('Select a disposition')
                    ->multiple()
                    ->options(
                        Cache::remember('dispositions_used_list', 60 * 60, function () {
                            return Contact::distinct()
                                ->pluck('disposition', 'disposition')
                                ->filter(fn($disposition) => $disposition !== null)
                                ->map(fn($disposition) => [$disposition => $disposition])
                                ->toArray();
                        })
                    ),
                DateRangeFilter::make('date')
                    ->label('Date')
                    ->placeholder('Select a date range'),
            ])
            ->actions([
                // ...
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(ContactImporter::class)
                    ->color(Color::Blue),

            ])
            ->bulkActions([
                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(ContactExporter::class)
                    ->color(Color::Green)
                // ->successNotificationBody(fn($export) => ContactExporter::getCompletedNotificationBody($export))
                // ->successNotificationTitle('Export completed')
                ,
            ]);
    }
}
