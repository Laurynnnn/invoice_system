<?php

namespace Modules\Invoice\Console;

use Illuminate\Console\Command;
use Modules\Invoice\Models\Subscription;
use Modules\Invoice\Http\Controllers\InvoiceController;

class SendInvoicesCommand extends Command
{
    protected $signature = 'invoices:send';
    protected $description = 'Create and send invoices for subscriptions with unpaid status and due date coming up in two months';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = now();
        $twoMonthsFromNow = $now->copy()->addMonths(2); // Adds 2 months to the current date and time

        // Retrieve subscriptions that are unpaid and due within the next two months
        $subscriptions = Subscription::where('payment_status', 'unpaid')
                                     ->whereBetween('end_date', [$now, $twoMonthsFromNow])
                                     ->get();

        foreach ($subscriptions as $subscription) {
            $invoiceController = new InvoiceController();
            $invoiceController->create($subscription->client_id); // Call the create method with the client ID
        }

        $this->info('Invoices have been created and sent successfully!');
    }
}


// namespace Modules\Invoice\Console;

// use Illuminate\Console\Command;
// use Modules\Client\Models\Client;
// use Modules\Invoice\Http\Controllers\InvoiceController;

// class SendInvoicesCommand extends Command
// {
//     protected $signature = 'invoices:send';
//     protected $description = 'Create and send invoices for clients with unpaid status and due date coming up in x minutes';

//     public function __construct()
//     {
//         parent::__construct();
//     }

//     public function handle()
//     {
//         $now = now();
//         $tenHoursFromNow = $now->copy()->addHours(10); //Adds 10 hours to the current date and time

//         $clients = Client::where('payment_status', 'unpaid')
//                          ->whereBetween('payment_due_date', [$now, $tenHoursFromNow])
//                          ->get();

//         foreach ($clients as $client) {
//             $invoiceController = new InvoiceController();
//             $invoiceController->create($client->id); // Call the create method with the client ID
//         }

//         $this->info('Invoices have been created and sent successfully!');
//     }
// }
