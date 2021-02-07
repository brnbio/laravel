<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class User
 *
 * @package App\Models
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property Carbon|null $email_verified_at
 * @property Carbon|null $deleted_at
 */
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    public const TABLE = 'core_users';

    public const ATTRIBUTE_NAME = 'name';
    public const ATTRIBUTE_EMAIL = 'email';
    public const ATTRIBUTE_PASSWORD = 'password';
    public const ATTRIBUTE_REMEMBER_TOKEN = 'remember_token';
    public const ATTRIBUTE_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const ATTRIBUTE_DELETED_AT = 'deleted_at';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_EMAIL,
        self::ATTRIBUTE_PASSWORD,
        self::ATTRIBUTE_REMEMBER_TOKEN,
    ];

    /**
     * @var array
     */
    protected $hidden = [
        self::ATTRIBUTE_PASSWORD,
        self::ATTRIBUTE_REMEMBER_TOKEN,
    ];

    /**
     * @var array
     */
    protected $casts = [
        self::ATTRIBUTE_EMAIL_VERIFIED_AT => 'datetime',
        self::ATTRIBUTE_DELETED_AT        => 'datetime',
    ];
}
