<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfAuthenticated
 *
 * @package App\Http\Middleware
 */
class RedirectIfAuthenticated
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
