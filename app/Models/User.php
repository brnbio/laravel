<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App\Models
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasFactory;
    use Notifiable;

    public const string TABLE = 'core_users';

    public const string ATTRIBUTE_NAME           = 'name';
    public const string ATTRIBUTE_EMAIL          = 'email';
    public const string ATTRIBUTE_PASSWORD       = 'password';
    public const string ATTRIBUTE_REMEMBER_TOKEN = 'remember_token';

    /**
     * @var array<string>
     */
    protected $fillable = [
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_EMAIL,
        self::ATTRIBUTE_PASSWORD,
        self::ATTRIBUTE_REMEMBER_TOKEN,
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        self::ATTRIBUTE_PASSWORD,
        self::ATTRIBUTE_REMEMBER_TOKEN,
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            self::ATTRIBUTE_PASSWORD => 'hashed',
        ];
    }
}
