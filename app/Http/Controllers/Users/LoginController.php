<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Controller;
use App\Http\Requests\Users\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Class LoginController
 *
 * @package App\Http\Controllers\Users
 *
 * TODO: ThrottleLogin (https://github.com/laravel/ui/blob/3.x/auth-backend/ThrottlesLogins.php)
 */
class LoginController extends Controller
{
    /**
     * @return Renderable
     */
    public function __invoke(): Renderable
    {
        return view('users.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if ( !$this->attemptLogin($request->validated(), $request->filled('remember'))) {
            throw ValidationException::withMessages([
                User::ATTRIBUTE_EMAIL => [trans('auth.failed')],
            ]);
        }

        return $this->sendLoginResponse($request);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /**
     * @param array $credentials
     * @param bool $remember
     * @return bool
     */
    protected function attemptLogin(array $credentials, bool $remember = false): bool
    {
        return Auth::guard()->attempt($credentials, $remember);
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    protected function sendLoginResponse(LoginRequest $request): RedirectResponse
    {
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }
}
