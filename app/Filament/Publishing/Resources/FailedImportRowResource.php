<?php

namespace App\Filament\Publishing\Resources;

use App\Filament\Publishing\Resources\FailedImportRowResource\Pages;
use App\Models\FailedImportRow;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class FailedImportRowResource extends Resource
{
    protected static ?string $model = FailedImportRow::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('data')
                //     ->required(),
                // Forms\Components\Select::make('import_id')
                //     ->relationship('import', 'id')
                //     ->required(),
                // Forms\Components\Textarea::make('validation_error')
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        Tables\Columns\TextColumn::make('import.file_name')
                            ->searchable()
                            ->copyable()
                            ->sortable(),
                        Tables\Columns\TextColumn::make('validation_error')
                            ->searchable()
                            ->color(Color::Red)
                            ->sortable(),
                        Tables\Columns\TextColumn::make('created_at')
                            ->dateTime()
                            ->sortable(),
                    ]),
                ]),
                Panel::make([
                    Tables\Columns\TextColumn::make('data')
                        ->searchable()
                        ->formatStateUsing(function ($state, $record) {
                            $data = Arr::only(
                                $record->data,
                                [
                                    'email',
                                    'First_Name',
                                    'Last_Name',
                                    'Phone_Number',
                                    'term_code',
                                    'script_name',
                                ]
                            );

                            return json_encode($data, JSON_PRETTY_PRINT);
                        }),
                ]),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFailedImportRows::route('/'),
        ];
    }
}
