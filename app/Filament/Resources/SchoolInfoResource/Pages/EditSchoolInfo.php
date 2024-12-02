<?php

namespace App\Filament\Resources\SchoolInfoResource\Pages;

use App\Filament\Resources\SchoolInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolInfo extends EditRecord
{
    protected static string $resource = SchoolInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
