@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subscriptions</h1>
    <a href="{{ route('subscriptions.create') }}" class="btn btn-primary mb-3">Create New Subscription</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client Name</th>
                <th>Billing Cycle (Years)</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->client->client_name }}</td>
                    <td>{{ $subscription->billing_cycle_years }}</td>
                    <td>{{ $subscription->amount }}</td>
                    <td>{{ ucfirst($subscription->payment_status) }}</td>
                    <td>{{ $subscription->start_date }}</td>
                    <td>{{ $subscription->end_date }}</td>
                    <td>
                        <a href="{{ route('subscriptions.show', $subscription->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('subscriptions.edit', $subscription->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
