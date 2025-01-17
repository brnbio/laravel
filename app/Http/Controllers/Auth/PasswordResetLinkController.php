<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

/**
 * Class PasswordResetLinkController
 *
 * @package App\Http\Controllers\Auth
 */
class PasswordResetLinkController
{
    /**
     * @return Response
     */
    public function create(): Response
    {
        return inertia('auth/forgot-password');
    }

    /**
     * @param PasswordResetRequest $request
     * @return RedirectResponse
     */
    public function store(PasswordResetRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink($request->validated());
        if ($status === Password::RESET_LINK_SENT) {
            flash()->success(__('We have emailed your password reset link!'));
            return redirect('/');
        }

        throw ValidationException::withMessages([
            User::ATTRIBUTE_EMAIL => [
                trans($status),
            ],
        ]);
    }
}
