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
            Stat::make('Pacientes', $patients)
                ->description('Total de registros de pacientes')
                ->descriptionIcon('heroicon-m-users')
                ->url("patients_report")
                ->openUrlInNewTab()
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total consultas', $consultations)
                ->description('Total de registros de consultas')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->url("consultations_report")
                ->openUrlInNewTab()
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total prescripciones', $prescriptions)
                ->description('Total de registros de prescripciones')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total de emergencias', $emergencies)
                ->description('Total de registros de emergencias')
                ->descriptionIcon('heroicon-m-document-plus')
                ->url("emergencies_report")
                ->openUrlInNewTab()
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total de licencias', $licenses)
                ->description('Total de registros de licencias')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->url("licenses_report")
                ->openUrlInNewTab()
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total de pagos', $payments)
                ->description('Total de registros de pagos')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->url("payments_report")
                ->openUrlInNewTab()
                ->color('info')
                ->chart([1,1]),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->isSuper() || auth()->user()->isAdmin();
    }
}
