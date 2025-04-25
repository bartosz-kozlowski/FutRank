<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]));

        return (new MailMessage)
            ->subject('🔒 Zresetuj swoje hasło')
            ->greeting('Cześć!')
            ->line('Otrzymaliśmy prośbę o zresetowanie hasła do Twojego konta.')
            ->action('Zresetuj hasło', $url)
            ->line('Ten link wygaśnie za 60 minut.')
            ->line('Jeśli nie Ty wysłałeś/aś tę prośbę, zignoruj tę wiadomość.')
            ->salutation('Pozdrawiamy, Zespół FutRank');
    }
}
