<?php

namespace Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Models\Client;
use Illuminate\Routing\Controller;
use Modules\Invoice\Models\Invoice;
use Modules\Invoice\Notifications\InvoiceNotification;

class InvoiceController extends Controller
{
    public function create($id)
    {
        $client = Client::findOrFail($id);

        // Retrieve the subscription associated with the client
        $subscription = $client->subscriptions()->latest()->first(); // Assuming there could be multiple subscriptions

        if ($subscription->payment_status !== 'paid') {
            // Create a new invoice with the amount from the client
            $invoice = new Invoice();
            $invoice->client_id = $client->id;
            $invoice->amount = $subscription->amount; // Get amount from the client record

            // Set due date to be the end date of the subscription
            $invoice->due_date = $subscription->end_date; // Get due date from the subscription's end date
            $invoice->save();

            // Send the notification
            $client->notify(new InvoiceNotification($invoice));

            // Return the invoice preview
            return view('invoice::preview', [
                'invoice' => $invoice,
                'clientName' => $client->client_name, // Pass the client name to the view
            ]);
        } else {
            // Optionally, you could return a message or redirect indicating the client has already paid or has no subscription
            return redirect()->back()->with('status', 'This client has either already paid or does not have an active subscription.');
        }
    }
}


// namespace Modules\Invoice\Http\Controllers;

// use Illuminate\Http\Request;
// use Modules\Client\Models\Client;
// use Illuminate\Routing\Controller;
// use Modules\Invoice\Models\Invoice;
// use Modules\Invoice\Notifications\InvoiceNotification;

// class InvoiceController extends Controller
// {
//     public function create($id)
//     {
//         $client = Client::findOrFail($id);

//         // Check if the client has already paid
//         if ($client->payment_status !== 'paid') {
//             // Create a new invoice with the amount from the client
//             $invoice = new Invoice();
//             $invoice->client_id = $client->id;
//             $invoice->amount = $client->amount; // Get amount from the client record
//             $invoice->due_date = $client->payment_due_date; // Get due date from the client record
//             $invoice->save();

//             // Send the notification
//             $client->notify(new InvoiceNotification($invoice));

//             // Return the invoice preview
//             return view('invoice::preview', [
//                 'invoice' => $invoice,
//                 'clientName' => $client->client_name, // Pass the client name to the view
//             ]);
//         } else {
//             // Optionally, you could return a message or redirect indicating the client has already paid
//             return redirect()->back()->with('status', 'This client has already paid and will not receive further reminders.');
//         }
//     }
// }
