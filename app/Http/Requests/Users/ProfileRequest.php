<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProfileRequest
 *
 * @package App\Http\Requests\Users
 */
class ProfileRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            User::ATTRIBUTE_NAME => [
                'required',
                'string',
            ],
            User::ATTRIBUTE_EMAIL => [
                'required',
                'email',
                Rule::unique(User::TABLE, User::ATTRIBUTE_EMAIL)->ignore(auth()->id())
            ]
        ];
    }
}
