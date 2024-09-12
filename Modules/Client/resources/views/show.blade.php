@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $client->client_name }}</h1>

    <div class="mb-4">
        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
        </form>
        <a href="{{ route('invoices.create', ['id' => $client->id]) }}" class="btn btn-primary">Create Invoice</a>
        <a href="{{ route('subscriptions.create', ['client_id' => $client->id]) }}" class="btn btn-primary">Create Subscription</a>
        <a href="{{ route('subscriptions.index', ['client_id' => $client->id]) }}" class="btn btn-primary">View Subscriptions</a>

    
        <form action="{{ route('clients.markAsPaid', $client->id) }}" method="POST" class="d-inline" onsubmit="return handleMarkAsPaid(event)">
            @csrf
            <button type="submit" class="btn btn-success" {{ $client->payment_status === 'paid' ? 'disabled' : '' }}>
                {{ $client->payment_status === 'paid' ? 'Already Paid' : 'Mark as Paid' }}
            </button>
        </form>
    </div>
    
    <script>
    function handleMarkAsPaid(event) {
        // Prevent the default form submission
        event.preventDefault();
    
        // Show success popup
        alert('Client has been marked as paid.');
    
        // Optionally submit the form programmatically
        event.target.submit();
    }
    </script>
    
    

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
