@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subscription Details</h1>

    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $subscription->id }}</td>
                </tr>
                <tr>
                    <th>Client Name</th>
                    <td>{{ $subscription->client->client_name }}</td>
                </tr>
                <tr>
                    <th>Billing Cycle (Years)</th>
                    <td>{{ $subscription->billing_cycle_years }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>{{ $subscription->amount }}</td>
                </tr>
                <tr>
                    <th>Payment Status</th>
                    <td>{{ ucfirst($subscription->payment_status) }}</td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td>{{ $subscription->start_date }}</td>
                </tr>
                <tr>
                    <th>End Date</th>
                    <td>{{ $subscription->end_date }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="form-group">
        <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">Back to Subscriptions</a>
        <a href="{{ route('subscriptions.edit', $subscription->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>

        <form action="{{ route('subscriptions.markAsPaid', $subscription->id) }}" method="POST" class="d-inline" onsubmit="return handleMarkAsPaid(event)">
            @csrf
            <button type="submit" class="btn btn-success" {{ $subscription->payment_status === 'paid' ? 'disabled' : '' }}>
                {{ $subscription->payment_status === 'paid' ? 'Already Paid' : 'Mark as Paid' }}
            </button>
        </form>
    </div>

    <script>
        function handleMarkAsPaid(event) {
            // Prevent the default form submission
            event.preventDefault();
        
            // Show success popup
            alert('Subscription has been marked as paid.');
        
            // Optionally submit the form programmatically
            event.target.submit();
        }
        </script>
</div>
@endsection
