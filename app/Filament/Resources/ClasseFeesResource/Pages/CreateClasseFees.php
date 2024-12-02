<?php

namespace App\Filament\Resources\ClasseFeesResource\Pages;

use App\Models\ClassesFees;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ClasseFeesResource;

class CreateClasseFees extends CreateRecord
{
    protected static string $resource = ClasseFeesResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if(isset($data['classesFees']))
        {
            foreach ($data['classesFees'] as $fee)
            {
                ClassesFees::create([
                    "academic_year_id" => $fee['academic_year_id'] ?? null,
                    "classe_id" => $fee['classe_id'] ?? null,
                    "school_fee_amount" => $fee['school_fee_amount'] ?? 0,
                    "transport_fee_amount" => $fee['transport_fee_amount'] ?? 0,
                    "registration_fee_amount" => $fee['registration_fee_amount'] ?? 0,
                ]);
            }
        }
        return $data['classesFees'];
    }
}
