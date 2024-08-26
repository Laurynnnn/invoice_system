@extends('layouts.app')

@section('title', 'Client Details')

@section('content')
<div class="container mt-5">
    <h1>Trashed Client Details</h1>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Client Name:</strong>
                    <p>{{ $client->name }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Facility Level:</strong>
                    <p>{{ $client->facility_level }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Location:</strong>
                    <p>{{ $client->location }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Contact Person:</strong>
                    <p>{{ $client->contact_person_name }} ({{ $client->contact_person_phone }})</p>
                </div>
                <div class="col-md-4">
                    <strong>Support Engineer:</strong>
                    <p>{{ $client->support_engineer_name }} ({{ $client->support_engineer_phone }})</p>
                </div>
                <div class="col-md-4">
                    <strong>Billing Cycle:</strong>
                    <p>{{ $client->billing_cycle }} years</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Created At:</strong>
                    <p>{{ $client->created_at }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Updated At:</strong>
                    <p>{{ $client->updated_at }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Deleted At:</strong>
                    <p>{{ $client->deleted_at }}</p>
                </div>
            </div>
            <form action="{{ route('clients.reactivate', $client->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to reactivate this client?')">Reactivate</button>
            </form>
        </div>
    </div>
    <a href="{{ route('clients.inactive') }}" class="btn btn-secondary mt-3">Back to Inactive Clients List</a>
</div>
@endsection
