<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Controller;
use App\Http\Requests\Users\ProfileRequest;
use App\Http\Requests\Users\UpdatePasswordRequest;
use App\Models\User;
use App\Notifications\Users\UpdatePasswordNotification;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Users
 */
class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @return Renderable
     */
    public function __invoke(Request $request): Renderable
    {
        return view('users.profile', ['user' => auth()->user()]);
    }

    /**
     * @param ProfileRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(ProfileRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->fill($request->validated());

        if ($user->save()) {
            flash()->success(__('Profile saved.'));
        } else {
            flash()->error(__('An error occurred.'));
        }

        return back();
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $data = $request->validated();
        if (!empty($newPassword = $data[User::ATTRIBUTE_NEW_PASSWORD])) {
            $user->password = Hash::make($newPassword);
        }

        if ($user->save()) {
            flash()->success(__('Profile saved.'));
            $user->notify(new UpdatePasswordNotification());
        } else {
            flash()->error(__('An error occurred.'));
        }

        return back();
    }
}
