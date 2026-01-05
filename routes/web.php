<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'ponudaDana'])->name('home');
Route::get('/ponuda-dana', [ProductController::class, 'ponudaDana'])->name('ponuda.dana');
Route::get('/katalog', [ProductController::class, 'index'])->name('products.index');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/termin', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/termin', [AppointmentController::class, 'store'])->name('appointments.store');

    Route::resource('services', ServiceController::class);
    Route::resource('materials', MaterialController::class);
    Route::resource('products', ProductController::class)->except(['index']);
    Route::resource('appointments', AppointmentController::class)->except(['create', 'store']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('appointments', App\Http\Controllers\Admin\AppointmentController::class);
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('materials', App\Http\Controllers\Admin\MaterialController::class);
});

require __DIR__.'/auth.php';
