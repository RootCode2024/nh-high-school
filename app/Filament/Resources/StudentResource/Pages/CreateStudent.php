<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Facades\Hash;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\StudentResource;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data = parent::mutateFormDataBeforeCreate($data);
        User::firstOrCreate([
            'uuid' => $data['uuid'],
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
        ], [
            'password' => Hash::make('password'),
        ]);
        return $data;
    }
}
