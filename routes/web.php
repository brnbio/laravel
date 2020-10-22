<?php

declare(strict_types=1);

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get ('/', Controllers\HomeController::class)->name('home');

Route::get ('/login', Controllers\Users\LoginController::class)->name('login');
Route::post('/login', [Controllers\Users\LoginController::class, 'login']);
Route::post('/logout', [Controllers\Users\LoginController::class, 'logout'])->name('logout');

#Route::get ('/users/forgot-password', [Core\Users\ForgotPasswordController::class, 'showLinkRequestForm'])->name('core.users.forgot-password');
#Route::post('/users/forgot-password', [Core\Users\ForgotPasswordController::class, 'sendResetLinkEmail']);
#Route::get ('/users/reset-password/{token}', [Core\Users\ResetPasswordController::class, 'showResetForm'])->name('core.users.reset-password');
#Route::post('/users/reset-password', [Core\Users\ResetPasswordController::class, 'reset']);