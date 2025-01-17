<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Class LoginRequest
 *
 * @package App\Http\Requests\Auth
 */
class NewPasswordRequest extends FormRequest
{
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
            'token'                  => [
                'required',
                'string',
            ],
            User::ATTRIBUTE_EMAIL    => [
                'required',
                Rule::email(),
            ],
            User::ATTRIBUTE_PASSWORD => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
        ];
    }
}
