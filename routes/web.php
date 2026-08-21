<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/', function () {
    return view('client.layouts.app');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.layouts.app');
    })->name('admin.dashboard');

    Route::get('product-types/options', [ProductTypeController::class, 'options'])->name('admin.product-types.options');
    Route::resource('products', ProductController::class)->names('admin.products');

    Route::get('categories/sidebar', [CategoryController::class, 'sidebar'])->name('admin.categories.sidebar');
    Route::get('categories/options', [CategoryController::class, 'options'])->name('admin.categories.options');
    Route::resource('categories', CategoryController::class)->only(['store', 'show', 'update', 'destroy'])->names('admin.categories');

    Route::get('brands/sidebar', [BrandController::class, 'sidebar'])->name('admin.brands.sidebar');
    Route::get('brands/options', [BrandController::class, 'options'])->name('admin.brands.options');
    Route::resource('brands', BrandController::class)->only(['store', 'show', 'update', 'destroy'])->names('admin.brands');
});


