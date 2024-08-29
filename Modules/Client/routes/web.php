<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Http\Controllers\ClientController;

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
//     Route::resource('client', ClientController::class)->names('client');
// });

Route::middleware(['auth'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::get('/client/inactive', [ClientController::class, 'inactive'])->name('clients.inactive');
    Route::patch('/client/reactivate/{id}', [ClientController::class, 'reactivate'])->name('clients.reactivate');
    Route::get('client/trashed/{id}', [ClientController::class, 'show_inactive'])->name('clients.show_inactive');
    // Route::get('/client/verify/{id}/{hash}', [ClientController::class, 'verifyEmail'])->name('client.verify');

});

Route::get('/client/verify/{id}/{hash}', [ClientController::class, 'verifyEmail'])->name('client.verify');
