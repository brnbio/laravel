<?php

declare(strict_types=1);

namespace App\Http\Controllers\Core\Users;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\View\View;

/**
 * Class LoginController
 * @package App\Http\Controllers\Core\Users
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('core.users.login');
    }

    /**
     * @return string
     */
    public function redirectTo(): string
    {
        return route('home');
    }
}
