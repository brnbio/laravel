<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Controller;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

/**
 * Class NotificationsController
 *
 * @package App\Http\Controllers\Users
 */
class NotificationsController extends Controller
{
    /**
     * @param Request $request
     * @return Renderable
     */
    public function __invoke(Request $request): Renderable
    {
        /** @var User $user */
        $user = Auth::user();

        return view('users.notifications', [
            'notifications' => $user->notifications()->paginate(),
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function markAllAsRead(): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $user->notifications()->each(function(DatabaseNotification $item) {
            $item->markAsRead();
        });

        return back();
    }
}
