<?php

namespace App\Filament\Resources\ProfessionsResource\pages;

use App\Filament\Resources\ProfessionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProfessions extends ManageRecords
{
    protected static string $resource = ProfessionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
