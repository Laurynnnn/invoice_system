<?php

namespace Modules\User\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        $roles = Role::all(); // Use Role::all() to get roles for multiple role selection

        return view('user::auth.register', compact('roles'));
    
    }
    
    // Handle user registration
    public function register(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign roles to the user
        $roles = $validated['roles'];
        $user->syncRoles($roles);

        // Auth::login($user);

        return redirect()->intended('users');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('user::auth.login');
    }

    // Handle user login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('patients');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle user logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Show the user edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all(); // Include roles for multiple role selection


        return view('user::auth.edit', compact('user', 'roles'));
    }

    // Handle user update
    public function update(UpdateUserRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::findOrFail($id);

        // dd($user);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
        ]);

        // dd($user);


        // Assign roles to the user
        $roles = $validated['roles'];
        $user->syncRoles($roles);

        // dd($user);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Handle user deletion
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    // Show the list of active users
    public function index()
    {
        $users = User::with(['createdBy', 'updatedBy', 'deletedBy'])->get();
        return view('user::index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user::show', compact('user'));
    }

    // Show the list of inactive (trashed) users
    public function inactive()
    {
        $users = User::onlyTrashed()->get(); // Fetch trashed users
        return view('user::inactive', compact('users'));
    }

    // Show the form for adding a new user
    public function create()
    {
        $roles = Role::all(); // Use Role::all() to get roles for multiple role selection

        return view('user::auth.register', compact('roles'));
    }

    // Handle adding a new user
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign roles to the user
        $roles = $validated['roles'];
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Reactivate a user
    public function reactivate($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')->with('success', 'User reactivated successfully');
    }

    public function show_inactive($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        return view('user::show_inactive', compact('user'));
    }
}
