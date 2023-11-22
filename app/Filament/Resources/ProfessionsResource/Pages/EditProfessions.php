<?php

namespace App\Filament\Resources\ProfessionsResource\Pages;

use App\Filament\Resources\ProfessionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessions extends EditRecord
{
    protected static string $resource = ProfessionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
