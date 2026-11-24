<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Petani;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogController::class, 'index'])->name('home');
Route::get('/produk/{product:slug}', [CatalogController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
    Route::middleware('role:petani')->prefix('petani')->name('petani.')->group(function () {
        Route::resource('produk', Petani\ProductController::class)
            ->parameters(['produk' => 'product'])->except(['show', 'destroy'])->names('products');
        Route::patch('/produk/{product}/toggle', [Petani\ProductController::class, 'toggle'])->name('products.toggle');
    });

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('kategori', Admin\CategoryController::class)
            ->parameters(['kategori' => 'category'])->except(['show', 'create'])->names('categories');
    });
});
