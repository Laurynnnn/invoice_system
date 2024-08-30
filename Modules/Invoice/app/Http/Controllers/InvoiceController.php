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

        // Create a new invoice with the amount from the client
        $invoice = new Invoice();
        $invoice->client_id = $client->id;
        $invoice->amount = $client->amount; // Get amount from the client record
        $invoice->due_date = now()->addYear(); // Set default due date for the demo
        $invoice->save();

        // Send the notification
        $client->notify(new InvoiceNotification($invoice));

        // return view('invoice::preview', compact('invoice'));
        return view('invoice::preview', [
            'invoice' => $invoice,
            'clientName' => $client->client_name, // Pass the client name to the view
        ]);
        
    }
}
