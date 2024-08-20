@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Role</h1>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
            </div>
            <div class="form-group">
                <label for="permissions">Permissions</label>
                <select name="permissions[]" class="form-control" multiple>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->name }}" 
                            @if($role->permissions->pluck('name')->contains($permission->name)) 
                                selected 
                            @endif>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Role</button>
        </form>
    </div>
@endsection
