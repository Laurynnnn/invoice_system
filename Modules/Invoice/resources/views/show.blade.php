{{-- resources/views/invoices/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Invoice Details</h1>
        <div class="card">
            <div class="card-header">
                Invoice #{{ $invoice->id }}
            </div>
            <div class="card-body">
                <p><strong>Client:</strong> {{ $invoice->client->client_name }}</p>
                <p><strong>Amount:</strong> {{ $invoice->invoice_amount }}</p>
                <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p>
                <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Back to Invoices</a>
            </div>
        </div>
    </div>
@endsection
