<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MaterialController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('services', App\Http\Controllers\ServiceController::class);
    
    Route::resource('materials', App\Http\Controllers\MaterialController::class);
    
    Route::resource('products', App\Http\Controllers\ProductController::class);
    
    Route::resource('appointments', App\Http\Controllers\AppointmentController::class);
    
    Route::get('/katalog', [ProductController::class, 'index'])->name('products.index');
    
    Route::get('/termin', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/termin', [AppointmentController::class, 'store'])->name('appointments.store');

    Route::get('/ponuda-dana', [ProductController::class, 'ponudaDana'])->name('ponuda.dana');

    

});

require __DIR__.'/auth.php';

