<?php

namespace App\Filament\Publishing\Resources\CampaignResource\Pages;

use App\Filament\Publishing\Resources\CampaignResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCampaigns extends ManageRecords
{
    protected static string $resource = CampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
