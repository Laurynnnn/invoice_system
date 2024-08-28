<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Invoice System')</title>
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
            background-color: #003366; /* Dark blue background */
            border-bottom: 1px solid #002244; /* Slightly darker border */
            color: #ffffff;
        }
        .navbar-brand {
            color: #ffffff;
            font-weight: bold;
        }
        .navbar-brand:hover {
            color: #b0bec5; /* Light gray-blue for hover */
        }
        .navbar-text {
            color: #ffffff;
        }
        .main-container {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 250px;
            background-color: #f0f2f5; /* Light gray background */
            border-right: 1px solid #ddd;
            min-height: calc(100vh - 56px); /* Adjust based on the navbar height */
            display: flex;
            flex-direction: column;
        }
        .sidebar .nav-link {
            color: #003366; /* Dark blue text */
        }
        .sidebar .nav-link.active {
            background-color: #003366; /* Dark blue background */
            color: #ffffff; /* White text */
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
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }
        .breadcrumb-item a {
            color: #003366; /* Dark blue text */
        }
        .breadcrumb-item a:hover {
            color: #002244; /* Slightly darker blue for hover */
        }
        .logout {
            margin-top: auto; /* Pushes the logout button to the bottom of the sidebar */
            padding: 10px;
            background-color: #f8f9fa; /* Background color to ensure visibility */
            text-align: center;
        }
        .btn-link {
            color: #003366; /* Dark blue text */
        }
        .btn-link:hover {
            color: #002244; /* Slightly darker blue for hover */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Invoice System</a>
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
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>

                <!-- Sidebar Links for User Management -->
                <div class="nav flex-column">
                    @can('manage users')
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" data-toggle="collapse" href="#usersSubmenu" role="button" aria-expanded="{{ request()->routeIs('users.*') ? 'true' : 'false' }}" aria-controls="usersSubmenu">
                        <i class="fas fa-users"></i> Users
                    </a>
                    <div class="collapse {{ request()->routeIs('users.*') ? 'show' : '' }}" id="usersSubmenu">
                        @can('manage users')
                        <a class="nav-link sub-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">Active Users</a>
                        @endcan
                        @can('manage users')
                        <a class="nav-link sub-link {{ request()->routeIs('users.inactive') ? 'active' : '' }}" href="{{ route('users.inactive') }}">Inactive Users</a>
                        @endcan
                        @can('manage users')
                        <a class="nav-link sub-link {{ request()->routeIs('users.create') ? 'active' : '' }}" href="{{ route('users.create') }}">Add User</a>
                        @endcan
                    </div>
                    @endcan

                    <!-- Roles Management Links -->
                    @can('assign roles')
                    <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" data-toggle="collapse" href="#rolesSubmenu" role="button" aria-expanded="{{ request()->routeIs('roles.*') ? 'true' : 'false' }}" aria-controls="rolesSubmenu">
                        <i class="fas fa-user-shield"></i> User Roles
                    </a>
                    <div class="collapse {{ request()->routeIs('roles.*') ? 'show' : '' }}" id="rolesSubmenu">
                        @can('assign roles')
                        <a class="nav-link sub-link {{ request()->routeIs('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}">Active Roles</a>
                        @endcan
                        @can('assign roles')
                        <a class="nav-link sub-link {{ request()->routeIs('roles.create') ? 'active' : '' }}" href="{{ route('roles.create') }}">Add Role</a>
                        @endcan
                    </div>
                    @endcan

                    <!-- Client Links -->
                    @canany(['view clients', 'create clients', 'update clients', 'delete clients'])
                    <a class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}" data-toggle="collapse" href="#clientsSubmenu" role="button" aria-expanded="{{ request()->routeIs('clients.*') ? 'true' : 'false' }}" aria-controls="clientsSubmenu">
                        <i class="fas fa-building"></i> Clients
                    </a>
                    <div class="collapse {{ request()->routeIs('clients.*') ? 'show' : '' }}" id="clientsSubmenu">
                        @can('view clients')
                            <a class="nav-link sub-link {{ request()->routeIs('clients.index') ? 'active' : '' }}" href="{{ route('clients.index') }}">Active Clients</a>
                        @endcan
                        @can('create clients')
                            <a class="nav-link sub-link {{ request()->routeIs('clients.create') ? 'active' : '' }}" href="{{ route('clients.create') }}">Add Client</a>
                        @endcan
                        @can('view clients')
                            <a class="nav-link sub-link {{ request()->routeIs('clients.inactive') ? 'active' : '' }}" href="{{ route('clients.inactive') }}">Inactive Clients</a>
                        @endcan
                    </div>
                    @endcanany


                </div>

                <!-- Logout Button -->
                @if(Auth::check())
                <div class="logout">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-dark">
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
