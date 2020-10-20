<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class User
 * @package App\Models\Core
 */
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasFactory;
    use MustVerifyEmail;
    use Notifiable;

    public const TABLE = 'core_users';
    public const ATTRIBUTE_NAME = 'name';
    public const ATTRIBUTE_EMAIL = 'email';
    public const ATTRIBUTE_EMAIL_VERFIFIED_AT = 'verified_at';
    public const ATTRIBUTE_PASSWORD = 'password';
    public const ATTRIBUTE_REMEMBER_TOKEN = 'remember_token';

    /**
     * @var array
     */
    protected $hidden = [
        self::ATTRIBUTE_PASSWORD,
        self::ATTRIBUTE_REMEMBER_TOKEN,
    ];

    /**
     * @param array $options
     * @return bool
     * @throws Exception
     */
    public function save(array $options = [])
    {
        if ($this->exists === false) {
            $this->setAttribute(self::ATTRIBUTE_REMEMBER_TOKEN, Str::random(40));
        }

        return parent::save($options);
    }
}
