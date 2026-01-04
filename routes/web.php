<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});




Route::resource('services', App\Http\Controllers\ServiceController::class);

Route::resource('materials', App\Http\Controllers\MaterialController::class);

Route::resource('products', App\Http\Controllers\ProductController::class);

Route::resource('appointments', App\Http\Controllers\AppointmentController::class);

Route::get('/katalog', [ProductController::class, 'index'])->name('products.index');

Route::get('/termin', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/termin', [AppointmentController::class, 'store'])->name('appointments.store');