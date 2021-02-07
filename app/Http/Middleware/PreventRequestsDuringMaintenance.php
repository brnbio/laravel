<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

/**
 * Class PreventRequestsDuringMaintenance
 *
 * @package App\Http\Middleware
 */
class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * @var array
     */
    protected $except = [
        //
    ];
}
