<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Models\Client;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Notification;
use Modules\Invoice\Models\BillingCycleAmount;
use Modules\Client\Http\Requests\StoreClientRequest;
use Modules\Client\Http\Requests\UpdateClientRequest;
use Modules\Client\Notifications\ClientEmailVerificationNotification;

class ClientController extends Controller
{
    public function __construct()
    {
        // Apply middleware for client management permissions
        $this->middleware('permission:view clients', ['only' => ['index', 'show', 'inactive', 'show_inactive']]);
        $this->middleware('permission:create clients', ['only' => ['create', 'store']]);
        $this->middleware('permission:update clients', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete clients', ['only' => ['destroy', 'reactivate']]);
    }

    public function index()
    {
        // Retrieve all clients
        $clients = Client::all();
        return view('client::index', compact('clients'));
    }

    public function create()
    {
        // $billingCycleAmounts = BillingCycleAmount::all(); // Fetch all billing cycle amounts
        return view('client::create');
    }


    public function store(StoreClientRequest $request)
    {
        // Create the client
        $client = Client::create($request->validated());

        // Set payment_due_date to 5 minutes after created_at
        $client->payment_due_date = now()->addMinutes(30);
        
        // Save the client
        $client->save();
    
        // Send email verification notification
        $client->notify(new ClientEmailVerificationNotification($client));
    
        return redirect()->route('clients.index')->with('success', 'Client created successfully. A verification email has been sent.');
    }

    public function verifyEmail($id, $hash)
    {
        $client = Client::findOrFail($id);

        if (sha1($client->email) === $hash) {
            // Mark email as verified
            $client->email_verified = true;
            $client->email_verified_at = now();
            $client->save();

            // Redirect to the verification success page
            return view('client::verification_success', [
                'client' => $client
            ]);
        }

        // Redirect to the verification failure page
        return view('client::verification_failure', [
            'client' => $client
        ]);
    }

    public function markAsPaid($clientId)
    {
        $client = Client::findOrFail($clientId);
        $client->payment_status = 'paid';
        $client->save();

        return redirect()->back()->with('status', 'Client marked as paid successfully.');
    }




    public function edit(Client $client)
    {
        // Show edit form
        return view('client::edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        // Validate and update client
        $client->update($request->validated());
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        // Soft delete the client
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    public function show($id)
    {
        // Retrieve a single client by id
        $client = Client::findOrFail($id);
        return view('client::show', compact('client'));
    }

     /**
     * Reactivate the specified resource.
     */
    public function reactivate($id)
    {
        $client = Client::onlyTrashed()->findOrFail($id);
        $client->restore();

        return redirect()->route('clients.index')->with('success', 'Client reactivated successfully.');
    }

    /**
     * Display a listing of inactive resources.
     */
    public function inactive()
    {
        $clients = Client::onlyTrashed()->get();
        return view('client::inactive', compact('clients'));
    }

    /**
     * Show a specific inactive client.
     */
    public function show_inactive($id)
    {
        $client = Client::onlyTrashed()->findOrFail($id);
        return view('client::show_inactive', compact('client'));
    }
}
