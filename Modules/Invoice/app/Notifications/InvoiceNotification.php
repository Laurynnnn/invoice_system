<?php

namespace Modules\Invoice\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Invoice\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Generate PDF
        $pdf = Pdf::loadView('invoice::pdf', ['invoice' => $this->invoice]);
        // Access the client's name through the relationship
        $clientName = $this->invoice->client->client_name;

        return (new MailMessage)
            ->subject('Your Invoice is Ready')
            ->greeting('Hello ' . $clientName . ',')
            ->line('Your invoice is attached to this email.')
            ->line('Invoice ID: ' . $this->invoice->id)
            ->line('Amount: $' . number_format($this->invoice->amount, 2))
            ->line('Due Date: ' . $this->invoice->due_date)
            ->attachData($pdf->output(), 'invoice_' . $this->invoice->id . '.pdf', [
                'mime' => 'application/pdf',
            ])
            ->cc('finance@example.com')
            ->cc('support@example.com');
    }
}
