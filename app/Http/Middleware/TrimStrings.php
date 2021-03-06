<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/**
 * Class TrimStrings
 *
 * @package App\Http\Middleware
 */
class TrimStrings extends Middleware
{
    /**
     * @var string[]
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];
}
