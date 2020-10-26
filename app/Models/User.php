<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;
use App\Notifications\Users\ResetPasswordNotification;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Class User
 *
 * @package App\Models\Core
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property Carbon|null $email_verified_at
 */
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasDatabaseNotifications;
    use HasFactory;
    use MustVerifyEmail;
    use Notifiable;

    public const TABLE = 'core_users';
    public const ATTRIBUTE_NAME = 'name';
    public const ATTRIBUTE_EMAIL = 'email';
    public const ATTRIBUTE_EMAIL_VERIFIED_AT = 'email_verified_at';
    public const ATTRIBUTE_PASSWORD = 'password';
    public const ATTRIBUTE_NEW_PASSWORD = 'new_password';
    public const ATTRIBUTE_NEW_PASSWORD_CONFIRMATION = 'new_password_confirmation';
    public const ATTRIBUTE_REMEMBER_TOKEN = 'remember_token';
    public const ATTRIBUTE_RESET_TOKEN = 'token';

    /**
     * @var string[]
     */
    protected $fillable = [
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_EMAIL,
        self::ATTRIBUTE_EMAIL_VERIFIED_AT,
        self::ATTRIBUTE_PASSWORD,
        self::ATTRIBUTE_REMEMBER_TOKEN,
    ];

    /**
     * @var string[]
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

    /**
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
