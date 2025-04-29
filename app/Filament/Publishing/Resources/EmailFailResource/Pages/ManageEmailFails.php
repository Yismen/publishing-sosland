<?php

namespace App\Filament\Publishing\Resources\EmailFailResource\Pages;

use App\Filament\Publishing\Resources\EmailFailResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEmailFails extends ManageRecords
{
    protected static string $resource = EmailFailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
