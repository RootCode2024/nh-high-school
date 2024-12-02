<?php

namespace App\Filament\Resources\ClasseFeesResource\Pages;

use App\Filament\Resources\ClasseFeesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClasseFees extends ListRecords
{
    protected static string $resource = ClasseFeesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
