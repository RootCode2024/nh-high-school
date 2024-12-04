<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\WelcomeNotification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\StudentResource;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Http;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data = parent::mutateFormDataBeforeCreate($data);

        // Créer ou récupérer l'utilisateur lié
        $user = User::firstOrCreate(
            [
                'uuid' => $data['uuid'],
                'email' => $data['email'],
            ],
            [
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'password' => Hash::make('password'),
            ]
        );

        // Envoyer un email de bienvenue
        Notification::send($user, new WelcomeNotification($user));

        // Envoyer un SMS (remplacez par une implémentation réelle d'envoi de SMS)
        // $this->sendSms($user->phone, "Bienvenue, {$user->name}! Votre c  xompte a été créé.");

        return $data;
    }

    /**
     * Envoyer un SMS au numéro donné (exemple fictif)
     */
    protected function sendSms(string $phone, string $message): void
    {
        // Exemple d'appel à une API SMS (remplacez par votre fournisseur SMS)

        Http::post('https://api.smsprovider.com/send', [
            'to' => $phone,
            'message' => $message,
        ]);
    }
}
