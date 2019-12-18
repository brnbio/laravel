<?php

declare(strict_types=1);

use App\Http\Controllers\Core;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get ('/', Core\HomeController::class)->name('home');

Route::get ('/users/login', [Core\Users\LoginController::class, 'showLoginForm'])->name('core.users.login');
Route::post('/users/login', [Core\Users\LoginController::class, 'login']);
Route::post('/users/logout', [Core\Users\LoginController::class, 'logout'])->name('core.users.logout');
Route::get ('/users/forgot-password', [Core\Users\ForgotPasswordController::class, 'showLinkRequestForm'])->name('core.users.forgot-password');
Route::post('/users/forgot-password', [Core\Users\ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get ('/users/reset-password/{token}', [Core\Users\ResetPasswordController::class, 'showResetForm'])->name('core.users.reset-password');
Route::post('/users/reset-password', [Core\Users\ResetPasswordController::class, 'reset']);

