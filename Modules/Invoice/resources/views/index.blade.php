{{-- resources/views/invoices/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Invoices</h1>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Create Invoice</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client Name</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->client->client_name }}</td>
                        <td>{{ $invoice->invoice_amount }}</td>
                        <td>{{ $invoice->due_date }}</td>
                        <td>{{ ucfirst($invoice->status) }}</td>
                        <td>
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            @if ($invoice->status === 'unpaid')
                                <form action="{{ route('invoices.markAsPaid', $invoice->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Mark as Paid</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
