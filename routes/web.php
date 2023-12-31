<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Product\DashboardProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman utama dan produk
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// Route untuk login dengan Google
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::middleware('auth')->group(function () {
    // Route untuk profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/address/edit', [AddressController::class, 'edit'])->name('address.edit');
    Route::patch('/address/update', [AddressController::class, 'update'])->name('address.update');

    // Route untuk dashboard dan produk (menggunakan resource controller)
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('dashboard/products', DashboardProductController::class)->except('show');
    Route::get('dashboard/products/pdf', [DashboardProductController::class, 'generatePDF'])->name('products.generatePdf');
    Route::post('/dashboard/products/store', [DashboardProductController::class, 'store'])->name('products.store');
});

// Auth routes
require __DIR__.'/auth.php';
