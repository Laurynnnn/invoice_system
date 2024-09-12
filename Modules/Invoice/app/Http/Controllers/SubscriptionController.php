<?php

namespace Modules\Invoice\Http\Controllers;

use Modules\Invoice\Models\Subscription;
use Modules\Client\Models\Client;
use Modules\Invoice\Http\Requests\StoreSubscriptionRequest;
use Modules\Invoice\Http\Requests\UpdateSubscriptionRequest;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class SubscriptionController extends Controller
{
    // Display a listing of subscriptions
    public function index()
    {
        $subscriptions = Subscription::with('client')->get();
        return view('invoice::subscriptions.index', compact('subscriptions'));
    }

    // Show the form for creating a new subscription
    public function create()
    {
        $clients = Client::all();
        return view('invoice::subscriptions.create', compact('clients'));
    }

    // Store a newly created subscription
    public function store(StoreSubscriptionRequest $request)
    {
        $validated = $request->validated();

        // Calculate end date based on start date and billing cycle years
        $startDate = \Carbon\Carbon::parse($validated['start_date']);
        $billingCycleYears = (int) $validated['billing_cycle_years']; // Ensure it's an integer

        // Calculate the end date by adding the billing cycle years to the start date
        $endDate = $startDate->copy()->addYears($billingCycleYears);

        // Add end_date to validated data
        $validated['end_date'] = $endDate->format('Y-m-d');

        // Create the subscription with validated data including the computed end_date
        Subscription::create($validated);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully.');
    }


    // Show a specific subscription
    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('invoice::subscriptions.show', compact('subscription'));
    }

    // Show the form for editing a subscription
    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        $clients = Client::all();
        return view('invoice::subscriptions.edit', compact('subscription', 'clients'));
    }

    // Update the specified subscription
    public function update(UpdateSubscriptionRequest $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $validated = $request->validated();

        // Calculate the end date
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = $startDate->copy()->addYears((int) $validated['billing_cycle_years']); // Ensure billing_cycle_years is cast to int

        // Update the subscription
        $subscription->update([
            'client_id' => $validated['client_id'],
            'billing_cycle_years' => $validated['billing_cycle_years'],
            'amount' => $validated['amount'],
            'payment_status' => $validated['payment_status'],
            'start_date' => $startDate->toDateString(), // Ensure date is stored as string
            'end_date' => $endDate->toDateString(),     // Ensure date is stored as string
        ]);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully.');
    }


    // Delete the specified subscription
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }

     /**
     * Reactivate the specified resource.
     */
    public function reactivate($id)
    {
        $subscription = Subscription::onlyTrashed()->findOrFail($id);
        $subscription->restore();

        return redirect()->route('clients.index')->with('success', 'Client reactivated successfully.');
    }

    /**
     * Display a listing of inactive resources.
     */
    public function inactive()
    {
        $subscriptions = Subscription::onlyTrashed()->get();
        return view('invoice::subscriptions.inactive', compact('subscriptions'));
    }

    /**
     * Show a specific inactive client.
     */
    public function show_inactive($id)
    {
        $subscription = Subscription::onlyTrashed()->findOrFail($id);
        return view('invoice::subscriptions.show_inactive', compact('client'));
    }
}
