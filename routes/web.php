<?php

declare(strict_types=1);

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('login', [Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [Controllers\Auth\AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('forgot-password');
    Route::post('forgot-password', [Controllers\Auth\PasswordResetLinkController::class, 'store']);
    Route::get('reset-password/{token}', [Controllers\Auth\NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [Controllers\Auth\NewPasswordController::class, 'store'])->name('password.update');
});

Route::middleware('auth')->group(function() {
    Route::get('/', fn() => inertia('dashboard'))->name('dashboard');
    Route::post('logout', [Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
