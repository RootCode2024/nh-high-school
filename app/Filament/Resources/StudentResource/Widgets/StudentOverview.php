<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StudentOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Nombre Total d\'Elèves', Student::get()->count()),
        ];
    }
}
