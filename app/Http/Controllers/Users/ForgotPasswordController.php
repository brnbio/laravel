<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Controller;
use App\Http\Requests\Users\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

/**
 * Class ForgotPasswordController
 *
 * @package App\Http\Controllers\Users
 */
class ForgotPasswordController extends Controller
{
    /**
     * @return Renderable
     */
    public function __invoke(): Renderable
    {
        return view('users.forgot-password');
    }

    /**
     * @param ForgotPasswordRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function sendResetLinkEmail(ForgotPasswordRequest $request): RedirectResponse
    {
        $response = Password::broker()
            ->sendResetLink(
                $request->validated()
            );

        if ($response !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                User::ATTRIBUTE_EMAIL => [__($response)],
            ]);
        }

        flash()->success(__('Password reset link sent.'));

        return back();
    }

}
