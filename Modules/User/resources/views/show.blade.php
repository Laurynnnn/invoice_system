@extends('layouts.app')

@section('title', 'User Details')

@section('content')
<div class="container mt-5">
    <h1>User Details</h1>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Name:</strong>
                    <p>{{ $user->name }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Email:</strong>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Username:</strong>
                    <p>{{ $user->username }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Roles:</strong>
                    <p>
                        @foreach($user->roles as $role)
                            <span class="badge badge-primary">{{ $role->name }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to Users List</a>
</div>
@endsection
