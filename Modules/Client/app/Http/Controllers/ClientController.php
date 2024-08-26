<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Client\Models\Client;
use Modules\Client\Http\Requests\StoreClientRequest;
use Modules\Client\Http\Requests\UpdateClientRequest;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        // Retrieve all clients
        $clients = Client::all();
        return view('client::index', compact('clients'));
    }

    public function create()
    {
        // Show create form
        return view('client::create');
    }

    public function store(StoreClientRequest $request)
{
    // Debugging: Check if the data is being received correctly
    // dd($request->all());

    // Proceed with saving the client
    Client::create($request->validated());

    return redirect()->route('clients.index')->with('success', 'Client created successfully.');
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
