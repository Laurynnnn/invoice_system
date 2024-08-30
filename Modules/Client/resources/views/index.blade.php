@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Clients</h1>
        @can('create clients')
            <a href="{{ route('clients.create') }}" class="btn btn-primary">Add New Client</a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Facility Level</th>
                    <th>Email</th>
                    <th>Contact Person</th>
                    <th>Contact Phone</th>
                    <th>Payment Status</th>
                    <td>Payment Due Date</td> <!-- Added payment due date -->
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->client_name }}</td>
                        <td>{{ $client->facility_level }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->contact_person_name }}</td>
                        <td>{{ $client->contact_person_phone }}</td>
                        <td>{{ $client->payment_status }}</td> <!-- Added payment status -->
                        <td>{{ $client->payment_due_date ? $client->payment_due_date: 'N/A' }}</td> <!-- Payment due date -->
                        <td>{{ $client->createdBy ? $client->createdBy->name : 'N/A' }}</td>
                        <td>
                            @can('view clients')
                                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">View</a>
                            @endcan
                            @can('update clients')
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan
                            @can('delete clients')
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
