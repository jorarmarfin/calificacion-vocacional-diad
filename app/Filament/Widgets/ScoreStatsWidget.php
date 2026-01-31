<?php

namespace App\Filament\Widgets;

use App\Traits\StatsTrait;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ScoreStatsWidget extends StatsOverviewWidget
{
    use StatsTrait;
    protected function getStats(): array
    {
        $ps06=$this->countScoreQuestion('06');
        $ps07=$this->countScoreQuestion('07');
        $ps08=$this->countScoreQuestion('08');
        $ps09=$this->countScoreQuestion('09');
        $ps10=$this->countScoreQuestion('10');


        return [
            Stat::make('ps06', $ps06)
                ->description('Pregunta sensible 06')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),
            Stat::make('ps07', $ps07)
                ->description('Pregunta sensible 07')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),
            Stat::make('ps08', $ps08)
                ->description('Pregunta sensible 08')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),
            Stat::make('ps09', $ps09)
                ->description('Pregunta sensible 09')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),
            Stat::make('ps10', $ps10)
                ->description('Pregunta sensible 10')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('primary'),
        ];
    }
    protected function getColumns(): int
    {
        return 5; // Mostrar las 4 estadísticas en una fila
    }
}
