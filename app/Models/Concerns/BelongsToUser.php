<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait HasUser
 * connect user to model
 *
 * @package App\Models\Concerns
 * @mixin Model
 * @property int $user_id
 * @property User $user
 */
trait BelongsToUser
{
    public const string ATTRIBUTE_USER_ID = 'user_id';
    public const string RELATION_USER     = 'user';

    /**
     * @return void
     */
    public static function bootBelongsToUser(): void
    {
        static::creating(function ($model) {
            if (empty($model->user_id)) {
                $model->user_id = auth()->id();
            }
        });
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::ATTRIBUTE_USER_ID);
    }
}
