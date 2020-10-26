<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ForgotPasswordRequest
 *
 * @package App\Http\Requests\Users
 */
class ForgotPasswordRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            User::ATTRIBUTE_EMAIL => [
                'required',
                'email',
            ],
        ];
    }
}
