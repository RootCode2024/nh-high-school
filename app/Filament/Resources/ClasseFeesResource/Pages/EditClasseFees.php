<?php

namespace App\Filament\Resources\ClasseFeesResource\Pages;

use App\Filament\Resources\ClasseFeesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClasseFees extends EditRecord
{
    protected static string $resource = ClasseFeesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
