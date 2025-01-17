<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

/**
 * Class LoginRequest
 *
 * @package App\Http\Requests\Auth
 */
class LoginRequest extends FormRequest
{
    public const string FIELD_USERNAME = User::ATTRIBUTE_EMAIL;
    public const string FIELD_PASSWORD = User::ATTRIBUTE_PASSWORD;
    public const string FIELD_REMEMBER = 'remember';

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            self::FIELD_USERNAME => [
                'required',
                'string',
                Rule::email(),
            ],
            self::FIELD_PASSWORD => [
                'required',
                'string',
            ],
            self::FIELD_REMEMBER => [
                'nullable',
                'boolean',
            ],
        ];
    }

    /**
     * @return void
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();
        $loginAttempt = Auth::attempt(
            $this->only(self::FIELD_USERNAME, self::FIELD_PASSWORD),
            $this->boolean(self::FIELD_REMEMBER),
        );
        if ($loginAttempt === false) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                self::FIELD_USERNAME => __('Invalid credentials.'),
            ]);
        }
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * @return void
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
        event(new Lockout($this));
        $seconds = RateLimiter::availableIn($this->throttleKey());
        throw ValidationException::withMessages([
            self::FIELD_USERNAME => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * @return string
     */
    public function throttleKey(): string
    {
        $throttleKey = $this->string(self::FIELD_USERNAME) . '|' . $this->ip();

        return str($throttleKey)->lower()->transliterate()->toString();
    }
}
