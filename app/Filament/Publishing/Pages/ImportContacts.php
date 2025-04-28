<?php

namespace App\Filament\Publishing\Pages;

use App\Filament\Imports\ContactImporter;
use App\Models\Contact;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ImportContacts extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.import-contacts';

    public static function canAccess(): bool
    {
        return true;

        return auth()->user()->canManageSettings();
    }

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
                    ->tooltip(fn ($state) => $state),
                TextColumn::make('campaign')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('disposition')
                    ->limit(15)
                    ->tooltip(fn ($state) => $state)
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
                // ...
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
                // ...
            ]);
    }
}
