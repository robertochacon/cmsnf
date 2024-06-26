<?php

namespace App\Filament\Resources\PaymentsResource\pages;

use App\Filament\Resources\PaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePayments extends ManageRecords
{
    protected static string $resource = PaymentsResource::class;

    protected static ?string $title = 'Pagos';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->createAnother(false)->label('Nuevo Pago')
            ->modalHeading('Nuevo registro')
            ->mutateFormDataUsing(function (array $data): array {
                $data['user_id'] = auth()->id();
                return $data;
            }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PaymentsResource\Widgets\PaymentsOverview::class,
        ];
    }
}
