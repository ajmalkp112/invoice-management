<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/store', [InvoiceController::class, 'store'])->name('invoice.store');
Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::get('/invoice/{id}/download', [InvoiceController::class, 'download'])->name('invoice.download');
