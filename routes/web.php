<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', fn () => redirect()->route(auth()->user()->role.'.dashboard'))
    ->middleware('auth')->name('dashboard');

require __DIR__.'/modules/1-akun-admin.php';
require __DIR__.'/modules/2-produk.php';
require __DIR__.'/modules/3-belanja.php';
require __DIR__.'/modules/4-pesanan-masuk.php';
