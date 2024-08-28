<?php

namespace Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Models\Client;
use Modules\Invoice\Models\BillingCycleAmount;
use Illuminate\Routing\Controller;
use Modules\Invoice\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the invoices.
     */
    public function index()
    {
        $invoices = Invoice::with('client')->get();
        return view('invoice::index', compact('invoices'));
    }

    /**
     * Show the form for creating a new invoice.
     */
    public function create(Request $request)
    {
        $clients = Client::all();
        $selectedClientId = $request->get('client_id');
        return view('invoices.create', compact('clients', 'selectedClientId'));
    }


    /**
     * Store a newly created invoice in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'due_date' => 'required|date',
        ]);

        $client = Client::findOrFail($request->client_id);

        // Fetch the client's billing cycle
        $billingCycleYears = $client->billing_cycle_years;

        // Fetch the amount based on the client's billing cycle
        $amount = BillingCycleAmount::where('billing_cycle_years', $billingCycleYears)->value('amount');

        $invoice = new Invoice();
        $invoice->client_id = $client->id;
        $invoice->invoice_amount = $amount; // Auto-filled based on billing cycle
        $invoice->due_date = $request->due_date;
        $invoice->status = 'unpaid'; // Automatically set the status

        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified invoice.
     */
    public function show($id)
    {
        $invoice = Invoice::with('client')->findOrFail($id);
        return view('invoice:;show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified invoice.
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $clients = Client::all();
        return view('invoice::edit', compact('invoice', 'clients'));
    }

    /**
     * Update the specified invoice in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'due_date' => 'required|date',
        ]);

        $invoice = Invoice::findOrFail($id);
        $client = Client::findOrFail($request->client_id);

        // Fetch the client's billing cycle
        $billingCycleYears = $client->billing_cycle_years;

        // Fetch the amount based on the client's billing cycle
        $amount = BillingCycleAmount::where('billing_cycle_years', $billingCycleYears)->value('amount');

        $invoice->client_id = $client->id;
        $invoice->invoice_amount = $amount; // Auto-filled based on billing cycle
        $invoice->due_date = $request->due_date;

        // Status is not fillable by user, so no update here
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified invoice from the database.
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    /**
     * Mark an invoice as paid.
     */
    public function markAsPaid($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->status = 'paid'; // Automatically set the status to paid
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice marked as paid.');
    }
}
