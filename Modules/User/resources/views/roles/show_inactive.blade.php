@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inactive Role Details</h1>
        <h2>{{ $role->name }}</h2>
        <h3>Permissions:</h3>
        <ul>
            @foreach($role->permissions as $permission)
                <li>{{ $permission->name }}</li>
            @endforeach
        </ul>
        <form action="{{ route('roles.reactivate', $role->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Reactivate</button>
        </form>
        <a href="{{ route('roles.inactive') }}" class="btn btn-primary">Back to Inactive Roles</a>
    </div>
@endsection
