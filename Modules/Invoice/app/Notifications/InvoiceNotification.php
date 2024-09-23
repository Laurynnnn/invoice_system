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
        // Generate the PDF invoice
        $pdf = Pdf::loadView('invoice::pdf', ['invoice' => $this->invoice]);

        // Access the client's name through the relationship
        $clientName = $this->invoice->client->client_name;

        return (new MailMessage)
            ->subject('Invoice #'. $this->invoice->id .' from Streamline Health Tech Ltd.')
            ->greeting('Dear ' . $clientName . ',')
            ->line('We hope this message finds you well. Please find your invoice attached below.')
            // ->line('Invoice Details:')
            // ->line('Invoice ID: ' . $this->invoice->id)
            // ->line('Total Amount: $' . number_format($this->invoice->amount, 2))
            // ->line('Due Date: ' . $this->invoice->due_date)
            ->line('We kindly request that you process the payment by the due date to avoid any late fees.')
            ->line('Should you have any questions or need further assistance, please do not hesitate to contact our support team.')
            ->line('Thank you for your prompt attention to this matter.')
            ->attachData($pdf->output(), 'invoice_' . $this->invoice->id . '.pdf', [
                'mime' => 'application/pdf',
            ])
            ->cc('laurynkantono@gmail.com')  // Finance office
            ->cc('ormservices100@gmail.com')  // Support contact
            ->salutation('Sincerely, Streamline Health Tech.');
    }
}
