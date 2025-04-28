<?php

namespace App\Filament\Publishing\Resources\FailedImportRowResource\Pages;

use App\Filament\Publishing\Resources\FailedImportRowResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFailedImportRows extends ManageRecords
{
    protected static string $resource = FailedImportRowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
