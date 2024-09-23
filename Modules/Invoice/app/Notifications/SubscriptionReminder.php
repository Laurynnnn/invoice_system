<?php

namespace Modules\Invoice\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Client\Models\Client;
use Modules\Invoice\Models\Subscription;
use Barryvdh\DomPDF\Facade\Pdf;

class SubscriptionReminder extends Notification
{
    use Queueable;

    protected $client;
    protected $subscription;

    public function __construct(Client $client, Subscription $subscription)
    {
        $this->client = $client;
        $this->subscription = $subscription;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $pdf = Pdf::loadView('invoice::pdf', ['invoice' => $this->subscription->invoice]);

        return (new MailMessage)
                    ->subject('Subscription Reminder')
                    ->greeting('Hello ' . $this->client->name)
                    ->line('This is a reminder that your subscription is unpaid.')
                    ->line('Please make a payment to avoid any service interruptions.')
                    ->attachData($pdf->output(), 'invoice_' . $this->subscription->id . '.pdf', [
                        'mime' => 'application/pdf',
                    ])
                    ->cc('laurynkantono@gmail.com')
                    ->cc('ormservices100@gmail.com')
                    ->salutation('Sincerely, Streamline Health Tech.');
    }
}
