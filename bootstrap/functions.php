<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

if ( !function_exists('user')) {
    /**
     * @return User
     */
    function user(): User
    {
        return Auth::user();
    }
}

if ( !function_exists('fas')) {
    /**
     * @param string $icon
     * @return HtmlString
     */
    function fas(string $icon): HtmlString
    {
        return html()->icon('fas fa-' . $icon);
    }
}