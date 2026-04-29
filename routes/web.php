<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.layouts.app');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.layouts.app');
    })->name('admin.dashboard');

    Route::resource('products', ProductController::class)->names('admin.products');
    
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->only(['store', 'show', 'update', 'destroy']);
});
