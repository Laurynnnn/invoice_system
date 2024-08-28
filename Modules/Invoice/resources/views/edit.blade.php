{{-- resources/views/invoices/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Invoice</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="client_id">Client</label>
                <select name="client_id" id="client_id" class="form-control">
                    <option value="">Select Client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->client_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $invoice->due_date }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Invoice</button>
        </form>
    </div>
@endsection
