<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Class Handler
 *
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * @var string[]
     */
    protected $dontReport = [];

    /**
     * @var string[]
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
}
