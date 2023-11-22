<?php

namespace App\Filament\Resources\ProfessionsResource\Pages;

use App\Filament\Resources\ProfessionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfessions extends ListRecords
{
    protected static string $resource = ProfessionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
