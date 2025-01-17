<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;

/**
 * Class HandleInertiaRequests
 *
 * @package App\Http\Middleware
 */
class HandleInertiaRequests extends Middleware
{
    /**
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'app'  => [
                'name' => config('app.name'),
            ],
            'auth' => [
                'user' => fn() => $request->user()?->only(User::ATTRIBUTE_EMAIL),
            ],
        ]);
    }
}
