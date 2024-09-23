<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\Models\User;
use Modules\Client\Models\Client;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserController extends Controller
{
    public function __construct()
    {
        // Apply middleware for user management permissions
        $this->middleware('permission:manage users', ['only' => [
            'index', 'show', 'create', 'store', 'edit', 'update', 'destroy', 'inactive', 'show_inactive', 'reactivate'
        ]]);
        
    }

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

        // Send email verification notification
        event(new Registered($user));

        return redirect()->route('users.index')->with('success', 'User created successfully. A verification email has been sent.');
    }

    // Handle email verification
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (! hash_equals($hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('login')->withErrors('The verification link has expired or is invalid.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('dashboard')->with('success', 'Your email has been verified.');
    }

    // Handle resend verification link
    // public function resendVerificationLink(Request $request)
    // {
    //     $user = Auth::user();

    //     if ($user->hasVerifiedEmail()) {
    //         return redirect()->route('dashboard')->with('success', 'Your email is already verified.');
    //     }

    //     $user->sendEmailVerificationNotification();

    //     return redirect()->route('dashboard')->with('success', 'A new verification link has been sent to your email address.');
    // }

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
            return redirect()->intended('dashboard');
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

    // Show the dashboard
    public function dashboard()
    {
        $now = now();
        $tenHoursFromNow = $now->copy()->addHours(10);

        // Clients who are in arrears
        // $arrearsClients = Client::where('payment_status', 'unpaid')
        //                         ->where('payment_due_date', '<', $now)
        //                         ->get()
        //                         ->map(function($client) use ($now) {
        //                             $client->days_overdue = $now->diffInDays($client->payment_due_date);
        //                             return $client;
        //                         });

        // // Clients with upcoming billing dates
        // $upcomingBillingClients = Client::whereBetween('payment_due_date', [$now, $tenHoursFromNow])
        //                                 ->get();

        // // Counts for charts
        // // $paidCount = Client::where('payment_status', 'paid')->count();
        // $arrearsCount = $arrearsClients->count();
        // $upcomingCount = $upcomingBillingClients->count();

        // return view('user::dashboard', compact('arrearsClients', 'upcomingBillingClients', 'paidCount', 'arrearsCount', 'upcomingCount'));
        return view('user::dashboard');
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

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
        ]);

        // Assign roles to the user
        $roles = $validated['roles'];
        $user->syncRoles($roles);

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

        // Send email verification notification
        event(new Registered($user));

        return redirect()->route('users.index')->with('success', 'User created successfully. A verification email has been sent.');
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
