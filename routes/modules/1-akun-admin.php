<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/lupa-password', [PasswordResetController::class, 'showForgot'])->name('password.request');
    Route::post('/lupa-password', [PasswordResetController::class, 'sendLink'])->middleware('throttle:6,1')->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showReset'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/password', [ProfileController::class, 'password'])->name('profile.password');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', Admin\DashboardController::class)->name('dashboard');

        Route::get('/petani', [Admin\FarmerController::class, 'index'])->name('farmers.index');
        Route::patch('/petani/{user}/toggle', [Admin\FarmerController::class, 'toggle'])->name('farmers.toggle');

        Route::get('/pengguna', [Admin\UserController::class, 'index'])->name('users.index');
        Route::patch('/pengguna/{user}/reset-password', [Admin\UserController::class, 'resetPassword'])->name('users.reset-password');

        Route::get('/laporan', [Admin\ReportController::class, 'index'])->name('reports.index');

        Route::get('/pesanan', [Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/pesanan/{order}', [Admin\OrderController::class, 'show'])->name('orders.show');
    });
});
