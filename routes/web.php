<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/featured', [ProductController::class, 'featured'])->name('products.featured');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');