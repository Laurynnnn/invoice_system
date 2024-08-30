<?php

namespace Modules\Invoice\Console;

use Illuminate\Console\Command;
use Modules\Client\Models\Client;
use Modules\Invoice\Http\Controllers\InvoiceController;

class SendInvoicesCommand extends Command
{
    protected $signature = 'invoices:send';
    protected $description = 'Create and send invoices for clients with unpaid status and due date coming up in 5 minutes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = now();
        $tenMinutesFromNow = $now->copy()->addMinutes(10);

        $clients = Client::where('payment_status', 'unpaid')
                        //  ->whereBetween('payment_due_date', [$now, $tenMinutesFromNow])
                         ->get();

        foreach ($clients as $client) {
            $invoiceController = new InvoiceController();
            $invoiceController->create($client->id); // Call the create method with the client ID
        }

        $this->info('Invoices have been created and sent successfully!');
    }
}
