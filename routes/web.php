<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman utama dan produk
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

Route::middleware('auth')->group(function () {
    // Route untuk profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk dashboard dan produk (menggunakan resource controller)
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('dashboard/products', DashboardProductController::class)->except('show');
    Route::post('/dashboard/products/store', [DashboardProductController::class, 'store'])->name('products.store');
});

// Auth routes
require __DIR__.'/auth.php';
