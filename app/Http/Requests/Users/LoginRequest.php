<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 *
 * @package App\Http\Requests\Users
 */
class LoginRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            User::ATTRIBUTE_EMAIL    => [
                'required',
                'string',
            ],
            User::ATTRIBUTE_PASSWORD => [
                'required',
                'string',
            ],
        ];
    }
}
