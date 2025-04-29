<?php

namespace App\Filament\Publishing\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\EmailFail;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Publishing\Resources\EmailFailResource\Pages;
use App\Filament\Publishing\Resources\EmailFailResource\RelationManagers;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class EmailFailResource extends Resource
{
    protected static ?string $model = EmailFail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make(
                    [
                        Tables\Columns\TextColumn::make('email_failed_at')
                            ->dateTime()
                            ->sortable(),
                        Tables\Columns\TextColumn::make('failable_id')
                            ->numeric()
                            ->sortable(),
                        Tables\Columns\TextColumn::make('failable_type')
                            ->searchable(),
                        Tables\Columns\TextColumn::make('created_at')
                            ->dateTime()
                            ->sortable()
                            ->toggleable(isToggledHiddenByDefault: true),
                        Tables\Columns\TextColumn::make('updated_at')
                            ->dateTime()
                            ->sortable()
                            ->toggleable(isToggledHiddenByDefault: true),
                    ],

                )
                    ->from('md'),
                Panel::make([
                    Stack::make([
                        Tables\Columns\TextColumn::make('data')
                            ->wrap()
                        // ->limit(400)
                        // ->tooltip(fn($record) => $record->data)
                        ,
                        Tables\Columns\TextColumn::make('exception')
                            ->wrap()
                        // ->limit(400)
                        // ->tooltip(fn($record) => $record->exception)
                        ,
                    ])->collapsible()
                        ->collapsed(false)
                ])
            ])
            ->filters([
                DateRangeFilter::make('email_failed_at')
                    ->label('Email Failed At')
                    ->placeholder('Select a date range'),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->label('Export')
                        ->exporter(\App\Filament\Exports\EmailFailExporter::class)
                        ->color(Color::Green),


                    //     Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmailFails::route('/'),
        ];
    }
}
