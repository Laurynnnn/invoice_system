<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoice\Http\Controllers\InvoiceController;

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
});

