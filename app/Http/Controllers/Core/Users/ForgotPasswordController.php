<?php

declare(strict_types=1);

namespace App\Http\Controllers\Core\Users;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\View\View;

/**
 * Class ForgotPasswordController
 * @package App\Http\Controllers\Core\Users
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * @return View
     */
    public function showLinkRequestForm(): View
    {
        return view('core.users.forgot-password');
    }
}
