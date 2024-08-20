<?php

use Modules\User\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\RolePermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group([], function () {
//     Route::resource('users', UserController::class);
// });

// Routes accessible to unauthenticated users
Route::group(['middleware' => ['web']], function () {
    // Login Routes
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login');

    // Logout Route
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

// Routes accessible to authenticated users
Route::group(['middleware' => ['web', 'auth']], function () {
    // Registration Routes
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    
    // User Management Routes
    Route::resource('users', UserController::class);
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    Route::get('/user/inactive', [UserController::class, 'inactive'])->name('users.inactive');
    Route::patch('/user/reactivate/{id}', [UserController::class, 'reactivate'])->name('users.reactivate');
    Route::get('user/trashed/{id}', [UserController::class, 'show_inactive'])->name('users.show_inactive');

     // Role Management Routes
     Route::resource('roles', RolePermissionController::class);
     Route::get('/roles/inactive', [RolePermissionController::class, 'inactive'])->name('roles.inactive');
     Route::patch('/roles/reactivate/{id}', [RolePermissionController::class, 'reactivate'])->name('roles.reactivate');
     Route::get('/roles/trashed/{id}', [RolePermissionController::class, 'show_Inactive'])->name('roles.show_inactive');
});





