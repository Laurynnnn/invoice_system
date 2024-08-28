<?php

namespace Modules\Client\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ClientEmailVerificationNotification extends Notification
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = route('client.verify', [
            'id' => $this->client->id,
            'hash' => sha1($this->client->email)
        ]);

        return (new MailMessage)
                    ->line('Please click the button below to verify your email address.')
                    ->action('Verify Email', $verificationUrl)
                    ->line('If you did not create an account, no further action is required.');
    }
}
