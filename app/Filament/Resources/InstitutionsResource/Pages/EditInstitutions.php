<?php

namespace App\Filament\Resources\InstitutionsResource\Pages;

use App\Filament\Resources\InstitutionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInstitutions extends EditRecord
{
    protected static string $resource = InstitutionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
