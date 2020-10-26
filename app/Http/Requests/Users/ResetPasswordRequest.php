<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResetPasswordRequest
 *
 * @package App\Http\Requests\Users
 * @property string $token
 */
class ResetPasswordRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            User::ATTRIBUTE_EMAIL       => [
                'required',
                'email',
            ],
            User::ATTRIBUTE_PASSWORD    => [
                'required',
                'min:8',
                'confirmed',
            ],
            User::ATTRIBUTE_RESET_TOKEN => [
                'required',
            ],
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            User::ATTRIBUTE_RESET_TOKEN => $this->token,
        ]);
    }
}
