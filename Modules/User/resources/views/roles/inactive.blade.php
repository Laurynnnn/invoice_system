@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inactive Roles</h1>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</td>
                        <td>
                            <a href="{{ route('roles.show_inactive', $role->id) }}" class="btn btn-info">View</a>
                            <form action="{{ route('roles.reactivate', $role->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Reactivate</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
