<?php

namespace App\Filament\Resources\PaymentsResource\Widgets;

use App\Models\Payments;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use function Filament\Support\format_number;

class PaymentsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Payments::get()->sum('cost');
        $withInsurance = Payments::where('insurance_id', 1)->get()->sum('cost');
        $withoutInsurance = Payments::where('insurance_id','!=',1)->get()->sum('cost');

        return [
            Stat::make('Total', '$'.format_number($total, 2))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total con seguro', '$'.format_number($withInsurance, 2))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([1,1]),
            Stat::make('Total sin seguro', '$'.format_number($withoutInsurance, 2))
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
