@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Role</h1>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <strong><label for="name">Role Name</label></strong>
                <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
            </div>
            <div class="form-group">
                <strong><label for="permissions">Permissions</label></strong>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-6 mb-3">
                            <h4>{{ $category->name }}</h4>
                            <div class="row">
                                @foreach($category->permissions as $permission)
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" id="permission-{{ $permission->id }}"
                                                @if($role->permissions->pluck('name')->contains($permission->name)) 
                                                    checked 
                                                @endif>
                                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Role</button>
        </form>
    </div>
@endsection
