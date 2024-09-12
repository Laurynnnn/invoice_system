@extends('layouts.app')

@section('title', 'Inactive Subscription Details')

@section('content')
    <h1>Inactive Subscription Details</h1>

    <a href="{{ route('subscriptions.inactive') }}" class="btn btn-primary mb-3">Back to Inactive Subscriptions</a>

    <div class="card">
        <div class="card-header">
            Subscription ID: {{ $subscription->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Client: {{ $subscription->client->name }}</h5>
            <p class="card-text"><strong>Start Date:</strong> {{ $subscription->start_date }}</p>
            <p class="card-text"><strong>End Date:</strong> {{ $subscription->end_date }}</p>
            <p class="card-text"><strong>Amount:</strong> {{ $subscription->amount }}</p>
            <p class="card-text"><strong>Payment Status:</strong> {{ $subscription->payment_status }}</p>
            <!-- Add more details if necessary -->
        </div>
        <div class="card-footer text-muted">
            <form action="{{ route('subscriptions.reactivate', $subscription->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success">Reactivate Subscription</button>
            </form>
        </div>
    </div>
@endsection
