<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('services', App\Http\Controllers\ServiceController::class);

Route::resource('materials', App\Http\Controllers\MaterialController::class);

Route::resource('appointments', App\Http\Controllers\AppointmentController::class);

Route::resource('orders', App\Http\Controllers\OrderController::class);


Route::resource('services', App\Http\Controllers\ServiceController::class);

Route::resource('materials', App\Http\Controllers\MaterialController::class);

Route::resource('appointments', App\Http\Controllers\AppointmentController::class);

Route::resource('orders', App\Http\Controllers\OrderController::class);


Route::resource('services', App\Http\Controllers\ServiceController::class);

Route::resource('materials', App\Http\Controllers\MaterialController::class);

Route::resource('products', App\Http\Controllers\ProductController::class);

Route::resource('appointments', App\Http\Controllers\AppointmentController::class);
