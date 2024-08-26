@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Clients</h1>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Add New Client</a>
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
                    <th>Location</th>
                    <th>Contact Person</th>
                    <th>Contact Phone</th>
                    <th>Email</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->client_name }}</td>
                        <td>{{ $client->facility_level }}</td>
                        <td>{{ $client->location }}</td>
                        <td>{{ $client->contact_person_name }}</td>
                        <td>{{ $client->contact_person_phone }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->createdBy ? $client->createdBy->name : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
