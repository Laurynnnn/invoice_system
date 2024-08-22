@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">Role Details</h1>
                <h2 class="mb-3">{{ $role->name }}</h2>

                <h3>Permissions:</h3>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>{{ $category->name }}</strong>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach($category->permissions as $permission)
                                            @if($role->permissions->contains($permission))
                                                <li class="list-group-item">
                                                    {{ $permission->name }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('roles.index') }}" class="btn btn-primary mt-4">Back to Roles</a>
            </div>
        </div>
    </div>
@endsection
