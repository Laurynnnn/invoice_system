{{-- resources/views/invoices/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Invoice</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf
            <select name="client_id" id="client_id" class="form-control">
                <option value="">Select Client</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $selectedClientId ? 'selected' : '' }}>
                        {{ $client->client_name }}
                    </option>
                @endforeach
            </select>
            

            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date') }}">
            </div>

            <button type="submit" class="btn btn-primary">Create Invoice</button>
        </form>
    </div>
@endsection
