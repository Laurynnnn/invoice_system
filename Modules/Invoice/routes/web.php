<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoice\Http\Controllers\InvoiceController;
use Modules\Invoice\Http\Controllers\SubscriptionController;

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
//     Route::resource('invoice', InvoiceController::class)->names('invoice');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('invoices/create/{id}', [InvoiceController::class, 'create'])->name('invoices.create');
    // Route::resource('invoices', InvoiceController::class)->except(['create']);

    Route::resource('subscriptions', SubscriptionController::class);
    Route::get('/subscription/inactive', [SubscriptionController::class, 'inactive'])->name('subscriptions.inactive');
    Route::patch('/subscription/reactivate/{id}', [SubscriptionController::class, 'reactivate'])->name('subscriptions.reactivate');
    Route::get('subscription/trashed/{id}', [SubscriptionController::class, 'show_inactive'])->name('subscriptions.show_inactive');
    Route::post('/subscriptions/{client}/mark-as-paid', [SubscriptionController::class, 'markAsPaid'])->name('subscriptions.markAsPaid');

});

