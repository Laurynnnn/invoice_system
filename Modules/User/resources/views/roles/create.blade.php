@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Role</h1>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <strong><label for="name">Role Name</label></strong>
                <input type="text" name="name" class="form-control" required>
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
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" id="permission-{{ $permission->id }}">
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
            <button type="submit" class="btn btn-primary">Create Role</button>
        </form>
    </div>
@endsection
