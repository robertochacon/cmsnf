<?php

namespace App\Filament\Widgets;

use App\Models\Consultations;
use App\Models\Emergencies;
use App\Models\Licenses;
use App\Models\Patients;
use App\Models\Payments;
use App\Models\Prescriptions;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use function Filament\Support\format_number;

class TotalesOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $patients = Patients::get()->count();
        $consultations = Consultations::get()->count();
        $prescriptions = Prescriptions::get()->count();
        $emergencies = Emergencies::get()->count();
        $licenses = Licenses::get()->count();
        $payments = Payments::get()->count();

        return [
            Stat::make('Total pacientes', $patients)
                ->descriptionIcon('heroicon-m-user')
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total consultas', $consultations)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total prescripciones', $prescriptions)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total de emergencias', $emergencies)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total de licencias', $licenses)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total de pagos', $payments)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([1,1]),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->isSuper() || auth()->user()->isAdmin();
    }
}
