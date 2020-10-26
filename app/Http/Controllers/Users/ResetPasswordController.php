<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Controller;
use App\Http\Requests\Users\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Class ResetPasswordController
 *
 * @package App\Http\Controllers\Users
 */
class ResetPasswordController extends Controller
{
    /**
     * @param Request $request
     * @param string|null $token
     * @return Renderable
     */
    public function __invoke(Request $request, string $token = null): Renderable
    {
        return view('users.reset-password', [
            'token' => $token,
        ]);
    }

    /**
     * @param ResetPasswordRequest $request
     * @param string $token
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function reset(ResetPasswordRequest $request, string $token): RedirectResponse
    {
        $response = $this->resetPassword($request);
        if ($response !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                User::ATTRIBUTE_EMAIL => [__($response)],
            ]);
        }

        flash()->success(__('Password reset.'));

        return redirect()->route('home');
    }

    /**
     * @param ResetPasswordRequest $request
     * @return string
     */
    protected function resetPassword(ResetPasswordRequest $request): string
    {
        return Password::broker()
            ->reset(
                $request->validated(),
                function (User $user, string $password) {
                    $user->update([
                        User::ATTRIBUTE_PASSWORD       => Hash::make($password),
                        User::ATTRIBUTE_REMEMBER_TOKEN => Str::random(40),
                    ]);
                    event(new PasswordReset($user));
                    Auth::guard()->login($user);
                }
            );
    }
}
