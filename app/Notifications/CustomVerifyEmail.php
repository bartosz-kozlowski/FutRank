<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $verifyUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('✉️ Potwierdź swój adres e-mail')
            ->greeting('Cześć!')
            ->line('Kliknij poniższy przycisk, aby potwierdzić swój adres e-mail i aktywować konto.')
            ->action('Potwierdź adres e-mail', $verifyUrl)
            ->line('Jeśli to nie Ty tworzyłeś konto, zignoruj tę wiadomość.')
            ->salutation('Pozdrawiamy, Zespół FutRank');
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }
}

