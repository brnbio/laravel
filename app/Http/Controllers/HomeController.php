<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Controller;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return Renderable
     */
    public function __invoke(): Renderable
    {
        return view('home');
    }
}