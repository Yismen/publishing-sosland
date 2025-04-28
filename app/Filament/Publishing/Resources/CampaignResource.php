<?php

namespace App\Filament\Publishing\Resources;

use App\Filament\Publishing\Resources\CampaignResource\Pages;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('banner_path')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('website')
                    ->url()
                    ->maxLength(255),
                Forms\Components\Select::make('keywords_operator')
                    ->default('&')
                    ->required()
                    ->label('Keywords Operator')
                    ->options([
                        '&' => 'Ampersand (&)',
                        '|' => 'Pipe (|)',
                    ])
                    ->helperText('The character used to decide if the keywords are inclusive (&) or exclusive (|).'),
                Forms\Components\TagsInput::make('keywords')
                    ->separator(',')
                    ->placeholder('Enter keywords separated by commas')
                    ->label('Keywords')
                // ->required()
                // ->afterStateUpdated(function (callable $set, $state) {
                //     $set('keywords', array_filter(explode(',', str($state)->lower())));
                // })
                ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('banner_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keywords_operator'),
                Tables\Columns\TextColumn::make('keywords')
                    ->badge()
                    ->separator(',')
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCampaigns::route('/'),
        ];
    }
}
