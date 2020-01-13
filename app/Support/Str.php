<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Str as BaseHelper;

/**
 * Class Str
 * @package App\Support
 */
class Str extends BaseHelper
{
    /**
     * @param array $replaces
     * @param string $subject
     * @return string
     */
    public static function replace(array $replaces, string $subject): string
    {
        foreach ($replaces as $search => $replace) {
            $subject = str_replace($search, $replace, $subject);
        }

        return $subject;
    }
}