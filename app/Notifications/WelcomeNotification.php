<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    public $user;

    /**
     * Crée une nouvelle notification.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Définit les canaux de diffusion.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Contenu de l'email.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bienvenue sur notre plateforme')
            ->greeting("Bonjour {$this->user->name},")
            ->line('Votre compte a été créé avec succès.')
            ->line('Vous pouvez maintenant vous connecter avec votre email.')
            ->action('Se connecter', url('/login'))
            ->line('Merci d\'utiliser notre application!');
    }
}
