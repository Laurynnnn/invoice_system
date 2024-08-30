@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invoice Preview</h1>

    <table class="table table-striped">
        <tr>
            <th>Client ID:</th>
            <td>{{ $invoice->client_id }}</td>
        </tr>
        <tr>
            <th>Client Name:</th>
            <td>{{ $clientName }}</td>
        </tr>
        <tr>
            <th>Amount to Pay:</th>
            <td>${{ number_format($invoice->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Due Date:</th>
            <td>{{ $invoice->due_date }}</td>
        </tr>
        <tr>
            <th>Created At:</th>
            <td>{{ $invoice->created_at }}</td>
        </tr>
    </table>

    <a href="{{ route('clients.show', $invoice->client_id) }}" class="btn btn-secondary">Back to Client</a>
</div>
@endsection
