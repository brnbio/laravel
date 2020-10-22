<?php

declare(strict_types=1);

namespace App\Http\Controllers\Core\Users;

use App\Http\Controllers\Controller;
use App\Models\Core\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ResetPasswordController
 * @package App\Http\Controllers\Core\Users
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * @param Request $request
     * @param string|null $token
     * @return View
     */
    public function showResetForm(Request $request, string $token = null): View
    {
        return view('core.users.reset-password', [
            'token' => $token,
            'email' => $request->get(User::ATTRIBUTE_EMAIL),
        ]);
    }

    /**
     * @return string
     */
    public function redirectTo(): string
    {
        return route('core.users.login');
    }

}
