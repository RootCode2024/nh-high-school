<?php

namespace App\Filament\Resources\SchoolInfoResource\Pages;

use App\Filament\Resources\SchoolInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolInfos extends ListRecords
{
    protected static string $resource = SchoolInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
