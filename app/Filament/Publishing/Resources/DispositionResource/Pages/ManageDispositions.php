<?php

namespace App\Filament\Publishing\Resources\DispositionResource\Pages;

use App\Filament\Publishing\Resources\DispositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDispositions extends ManageRecords
{
    protected static string $resource = DispositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
