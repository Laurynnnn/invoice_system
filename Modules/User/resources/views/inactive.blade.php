@extends('layouts.app')

@section('title', 'Inactive Users')

@section('content')
<div class="container">
    <h1>Inactive Users</h1>
    <a href="{{ route('users.index') }}" class="btn btn-primary mb-3">Back to Active Users</a>
    <div class="card">
        <div class="card-body">
            @if($users->isEmpty())
                <p>No inactive users found.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Roles</th> <!-- Updated to show roles -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-secondary">{{ ucfirst($role->name) }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('users.reactivate', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to reactivate this user?')">Reactivate</button>
                                    </form>
                                    <a href="{{ route('users.show_inactive', $user) }}" class="btn btn-info btn-sm">View</a>
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
