<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Model;
use Illuminate\Support\Str;

/**
 * Trait HasUUID
 * Add UUID to model and use it as route key
 *
 * @package App\Models\Concerns
 * @property string $uuid
 * @mixin Model
 */
trait HasUUID
{
    public const string ATTRIBUTE_UUID = 'uuid';

    /**
     * @return void
     */
    public static function bootHasUUID(): void
    {
        static::creating(function($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return self::ATTRIBUTE_UUID;
    }
}
