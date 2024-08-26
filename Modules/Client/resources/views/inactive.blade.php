@extends('layouts.app')

@section('title', 'Inactive Clients')

@section('content')
<div class="container">
    <h1>Inactive Clients</h1>
    <a href="{{ route('clients.index') }}" class="btn btn-primary mb-3">Back to Active Clients</a>
    <div class="card">
        <div class="card-body">
            @if($clients->isEmpty())
                <p>No inactive clients found.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Facility Level</th>
                            <th>Location</th>
                            <th>Contact Person</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->facility_level }}</td>
                                <td>{{ $client->location }}</td>
                                <td>{{ $client->contact_person_name }} ({{ $client->contact_person_phone }})</td>
                                <td>
                                    <form action="{{ route('clients.reactivate', $client->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to reactivate this client?')">Reactivate</button>
                                    </form>
                                    <a href="{{ route('clients.show_inactive', $client) }}" class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
