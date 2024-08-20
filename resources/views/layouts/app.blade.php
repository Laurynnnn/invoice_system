<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EMR System')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
        }
        .main-container {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 250px;
            background-color: #535863;
            border-right: 1px solid #ddd;
            min-height: calc(100vh - 56px); /* Adjust based on the navbar height */
            position: relative;
        }
        .sidebar .nav-link {
            color: #fefcfc;
        }
        .sidebar .nav-link.active {
            background-color: #2e89e4;
            border-radius: 4px;
        }
        .sidebar .nav-link.sub-link {
            padding-left: 30px;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #ffffff;
        }
        .navbar-brand {
            margin-right: 1rem;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }
        .breadcrumb-item a {
            color: #2e89e4;
        }
        .logout {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">EMR System</a>
        <div class="d-flex align-items-center ml-auto">
            @if(Auth::check())
                <div class="d-flex align-items-center">
                    <span class="navbar-text mr-2">{{ Auth::user()->name }}</span>
                    <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-circle">
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-link">Login</a>
            @endif
        </div>
    </nav>

    <!-- Main Container -->
    <div class="main-container">
        <div class="sidebar">
            @if(Auth::check())
            <div class="nav flex-column">

                <!-- Users Main Link with Sub-links -->
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" data-toggle="collapse" href="#usersSubmenu" role="button" aria-expanded="{{ request()->routeIs('users.*') ? 'true' : 'false' }}" aria-controls="usersSubmenu">
                    <i class="fas fa-users"></i> Users
                </a>
                <div class="collapse {{ request()->routeIs('users.*') ? 'show' : '' }}" id="usersSubmenu">
                    <a class="nav-link sub-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">Active Users</a>
                    <a class="nav-link sub-link {{ request()->routeIs('users.inactive') ? 'active' : '' }}" href="{{ route('users.inactive') }}">Inactive Users</a>
                    <a class="nav-link sub-link {{ request()->routeIs('users.create') ? 'active' : '' }}" href="{{ route('users.create') }}">Add User</a>
                </div>

                <!-- Roles Main Link with Sub-links -->
                <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" data-toggle="collapse" href="#rolesSubmenu" role="button" aria-expanded="{{ request()->routeIs('roles.*') ? 'true' : 'false' }}" aria-controls="rolesSubmenu">
                    <i class="fas fa-user-shield"></i> User Roles
                </a>
                <div class="collapse {{ request()->routeIs('roles.*') ? 'show' : '' }}" id="rolesSubmenu">
                    <a class="nav-link sub-link {{ request()->routeIs('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}">Active Roles</a>
                    {{-- <a class="nav-link sub-link {{ request()->routeIs('roles.inactive') ? 'active' : '' }}" href="{{ route('roles.inactive') }}">Inactive Roles</a> --}}
                    <a class="nav-link sub-link {{ request()->routeIs('roles.create') ? 'active' : '' }}" href="{{ route('roles.create') }}">Add Role</a>
                </div>

                <!-- Logout Button -->
                @if(Auth::check())
                <div class="logout">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-light">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
                @endif
            </div>
            @endif
        </div>
        <div class="content">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumbs')
                </ol>
            </nav>
            
            <!-- Main Content -->
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
