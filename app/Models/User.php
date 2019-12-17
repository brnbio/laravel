<?php

declare(strict_types=1);

namespace App\Models;

use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class User
 * @package App\Models
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
    use Notifiable;

    public const TABLE = 'core_users';
    public const ATTRIBUTE_NAME = 'name';
    public const ATTRIBUTE_EMAIL = 'email';
    public const ATTRIBUTE_PASSWORD = 'password';
    public const ATTRIBUTE_REMEMBER_TOKEN = 'remember_token';
    public const ATTRIBUTE_VERIFIED_AT = 'verified_at';

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
        self::ATTRIBUTE_VERIFIED_AT => 'datetime',
    ];

    /**
     * @param array $options
     * @return bool
     * @throws Exception
     */
    public function save(array $options = [])
    {
        if ($this->exists === false) {
            $this->setAttribute(self::ATTRIBUTE_REMEMBER_TOKEN, Str::random(10));
        }

        return parent::save($options);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute(self::ATTRIBUTE_NAME);
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->setAttribute(self::ATTRIBUTE_NAME, $name);

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getAttribute(self::ATTRIBUTE_EMAIL);
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->setAttribute(self::ATTRIBUTE_EMAIL, $email);

        return $this;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->setAttribute(self::ATTRIBUTE_PASSWORD, Hash::make($password));

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function fill(array $attributes): self
    {
        if (!empty($attributes[self::ATTRIBUTE_NAME])) {
            $this->setName($attributes[self::ATTRIBUTE_NAME]);
        }

        if (!empty($attributes[self::ATTRIBUTE_EMAIL])) {
            $this->setEmail($attributes[self::ATTRIBUTE_EMAIL]);
        }

        if (!empty($attributes[self::ATTRIBUTE_PASSWORD])) {
            $this->setPassword($attributes[self::ATTRIBUTE_PASSWORD]);
        }

        return $this;
    }
}
