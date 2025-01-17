<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\NewPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

/**
 * Class NewPasswordController
 *
 * @package App\Http\Controllers\Auth
 */
class NewPasswordController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        return inertia('auth/reset-password', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * @param NewPasswordRequest $request
     * @return RedirectResponse
     */
    public function store(NewPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->validated(),
            function(User $user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->remember_token = Str::random(100);
                $user->save();
                event(new PasswordReset($user));
            },
        );

        if ($status === Password::PASSWORD_RESET) {
            flash()->success(__('Password reset successfully!'));
            return to_route('login');
        }

        throw ValidationException::withMessages([
            User::ATTRIBUTE_EMAIL => [trans($status)],
        ]);
    }
}
