@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role Details</h1>
        <h2>{{ $role->name }}</h2>
        <h3>Permissions:</h3>
        <ul>
            @foreach($role->permissions as $permission)
                <li>{{ $permission->name }}</li>
            @endforeach
        </ul>
        <a href="{{ route('roles.index') }}" class="btn btn-primary">Back to Roles</a>
    </div>
@endsection
