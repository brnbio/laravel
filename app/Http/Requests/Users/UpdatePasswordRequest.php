<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePasswordRequest
 *
 * @package App\Http\Requests\Users
 */
class UpdatePasswordRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            User::ATTRIBUTE_PASSWORD     => [
                'required',
                'password',
            ],
            User::ATTRIBUTE_NEW_PASSWORD => [
                'nullable',
                'min:8',
                'confirmed',
            ],
        ];
    }
}
