<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// -----------------------------------------------------------------Path: app/Http/Controllers/Api/ProductController.php
Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);
Route::post('/products', [App\Http\Controllers\Api\ProductController::class, 'store']);
Route::get('/products/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);
Route::get('/products/{id}/edit', [App\Http\Controllers\Api\ProductController::class, 'edit']);
Route::put('/products/{id}/edit', [App\Http\Controllers\Api\ProductController::class, 'update']);
Route::delete('/products/{id}/delete', [App\Http\Controllers\Api\ProductController::class, 'destroy']);

// ----------------------------------------------------------------Path: app/Http/Controllers/Api/CategoryController.php
Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::post('/categories', [App\Http\Controllers\Api\CategoryController::class, 'store']);
Route::get('/categories/{id}', [App\Http\Controllers\Api\CategoryController::class, 'show']);
Route::get('/categories/{id}/edit', [App\Http\Controllers\Api\CategoryController::class, 'edit']);
Route::put('/categories/{id}/edit', [App\Http\Controllers\Api\CategoryController::class, 'update']);
Route::delete('/categories/{id}/delete', [App\Http\Controllers\Api\CategoryController::class, 'destroy']);
