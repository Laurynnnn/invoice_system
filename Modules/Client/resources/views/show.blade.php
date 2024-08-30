@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $client->client_name }}</h1>

    <div class="mb-3">
        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
        </form>
        <a href="{{ route('invoices.create', ['id' => $client->id]) }}" class="btn btn-primary">Create Invoice</a>
    </div>

    <table class="table table-striped">
        <tr>
            <th>Facility Level</th>
            <td>{{ $client->facility_level }}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>{{ $client->location }}</td>
        </tr>
        <tr>
            <th>Contact Person Name</th>
            <td>{{ $client->contact_person_name }}</td>
        </tr>
        <tr>
            <th>Contact Person Phone</th>
            <td>{{ $client->contact_person_phone }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $client->email }}</td>
        </tr>
        <tr>
            <th>Support Engineer Name</th>
            <td>{{ $client->support_engineer_name }}</td>
        </tr>
        <tr>
            <th>Support Engineer Phone</th>
            <td>{{ $client->support_engineer_phone }}</td>
        </tr>
        <tr>
            <th>Support Engineer Email</th>
            <td>{{ $client->support_engineer_email }}</td>
        </tr>
        <tr>
            <th>Billing Cycle (Years)</th>
            <td>{{ $client->billing_cycle_years }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>{{ $client->amount }}</td>
        </tr>
    </table>

    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to Clients</a>
</div>
@endsection
