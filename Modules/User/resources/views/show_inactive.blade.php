@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="container mt-5">
    <h1>Trashed User Details</h1>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Username:</strong>
                    <p>{{ $user->username }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Name:</strong>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Email:</strong>
                    <p>{{ $user->email }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Roles:</strong>
                    <p>
                        @foreach($user->roles as $role)
                            <span class="badge bg-secondary">{{ ucfirst($role->name) }}</span>
                        @endforeach
                    </p>
                </div>
                <div class="col-md-4">
                    <strong>Created At:</strong>
                    <p>{{ $user->created_at }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Updated At:</strong>
                    <p>{{ $user->updated_at }}</p>
                </div>
            </div>
            <form action="{{ route('users.reactivate', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to reactivate this user?')">Reactivate</button>
            </form>
        </div>
    </div>
    <a href="{{ route('users.inactive') }}" class="btn btn-secondary mt-3">Back to Inactive Users List</a>
</div>
@endsection
