<?php

namespace App\Filament\Publishing\Resources\DispositionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Publishing\Resources\DispositionResource;

class EditDisposition extends EditRecord
{
    protected static string $resource = DispositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
