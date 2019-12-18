<?php

declare(strict_types=1);

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class WelcomeController
 * @package App\Http\Controllers\Core
 */
class HomeController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('core.home');
    }
}