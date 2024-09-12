@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Subscription</h1>

    <form action="{{ route('subscriptions.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Client Dropdown -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="client_id">Client</label>
                    <select name="client_id" id="client_id" class="form-control">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Billing Cycle (Years) -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="billing_cycle_years">Billing Cycle (Years)</label>
                    <input type="number" name="billing_cycle_years" id="billing_cycle_years" class="form-control" value="{{ old('billing_cycle_years') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Amount -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
                </div>
            </div>

            <!-- Payment Status -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="form-control">
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Start Date -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                </div>
            </div>

            {{-- <!-- End Date -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                </div>
            </div> --}}
        </div>

        <!-- Buttons -->
        <div class="form-group">
            <button type="submit" class="btn btn-success">Create Subscription</button>
            <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
