<?php

namespace App\Filament\Resources\LicensesResource\Pages;

use App\Filament\Resources\LicensesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLicenses extends CreateRecord
{
    protected static string $resource = LicensesResource::class;

    protected static ?string $title = 'Crear Licencia Médica';

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
