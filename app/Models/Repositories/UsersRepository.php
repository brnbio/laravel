<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\User;
use App\Repository;

/**
 * Class UsersRepository
 *
 * @package App\Models\Repositories
 */
class UsersRepository extends Repository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return User::class;
    }
}
