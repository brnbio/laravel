<?php

declare(strict_types=1);

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('login', [Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [Controllers\Auth\AuthenticatedSessionController::class, 'store']);


    //    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //        ->name('password.request');
    //
    //    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    //        ->name('password.email');
    //
    //    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    //        ->name('password.reset');
    //
    //    Route::post('reset-password', [NewPasswordController::class, 'store'])
    //        ->name('password.store');
});

Route::middleware('auth')->group(function() {
    Route::get('/', fn() => inertia('dashboard'))->name('dashboard');
    Route::post('logout', [Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
