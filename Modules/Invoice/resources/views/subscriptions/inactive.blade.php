@extends('layouts.app')

@section('title', 'Inactive Subscriptions')

@section('content')
    <h1>Inactive Subscriptions</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->client->name }}</td>
                    <td>{{ $subscription->start_date }}</td>
                    <td>{{ $subscription->end_date }}</td>
                    <td>{{ $subscription->amount }}</td>
                    <td>{{ $subscription->payment_status }}</td>
                    <td>
                        <a href="{{ route('subscriptions.show_inactive', $subscription->id) }}" class="btn btn-info">View</a>
                        <!-- Add other actions if needed -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
