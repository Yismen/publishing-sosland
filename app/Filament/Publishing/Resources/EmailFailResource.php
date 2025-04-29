<?php

namespace App\Filament\Publishing\Resources;

use App\Filament\Publishing\Resources\EmailFailResource\Pages;
use App\Filament\Publishing\Resources\EmailFailResource\RelationManagers;
use App\Models\EmailFail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmailFailResource extends Resource
{
    protected static ?string $model = EmailFail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email_failed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('failable_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('failable_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data')
                    ->wrap()
                    ->limit(400)
                    ->tooltip(fn($record) => $record->data),
                Tables\Columns\TextColumn::make('exception')
                    ->wrap()
                    ->limit(400)
                    ->tooltip(fn($record) => $record->exception),
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
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmailFails::route('/'),
        ];
    }
}
