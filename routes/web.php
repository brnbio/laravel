<?php

declare(strict_types=1);

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

# guest routes
Route::get ('/', Controllers\HomeController::class)->name('home');
Route::get ('/login', Controllers\Users\LoginController::class)->name('login');
Route::post('/login', [Controllers\Users\LoginController::class, 'login']);
Route::post('/logout', [Controllers\Users\LoginController::class, 'logout'])->name('logout');
Route::get ('/forgot-password', Controllers\Users\ForgotPasswordController::class)->name('forgot-password');
Route::post('/forgot-password', [Controllers\Users\ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get ('/reset-password/{token}', Controllers\Users\ResetPasswordController::class)->name('reset-password');
Route::post('/reset-password/{token}', [Controllers\Users\ResetPasswordController::class, 'reset']);

# auth routes
Route::middleware(['auth'])->group(function() {
    Route::get ('/profile', Controllers\Users\ProfileController::class)->name('profile');
    Route::post('/profile', [Controllers\Users\ProfileController::class, 'store']);
    Route::post('/profile/password', [Controllers\Users\ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::get ('/profile/notifications', Controllers\Users\NotificationsController::class)->name('profile.notifications');
    Route::post('/profile/notifications/mark-all-read', [Controllers\Users\NotificationsController::class, 'markAllAsRead'])->name('profile.notifications.mark-all-read');
});