<?php

declare(strict_types=1);

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * Class Model
 *
 * @package App
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Model extends BaseModel
{
    public const TABLE = '';

    public const ATTRIBUTE_ID = 'id';
    public const ATTRIBUTE_UUID = 'uuid';
    public const ATTRIBUTE_CREATED_AT = 'created_at';
    public const ATTRIBUTE_UPDATED_AT = 'updated_at';

    /**
     * @return string
     */
    public function getTable(): string
    {
        return static::TABLE ?: parent::getTable();
    }

    /**
     * @param array $options
     * @return bool
     * @throws Exception
     */
    public function save(array $options = [])
    {
        if ($this->exists === false) {
            $uuid = Uuid::uuid4()->toString();
            $this->setAttribute(self::ATTRIBUTE_UUID, $uuid);
        }

        return parent::save($options);
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return self::ATTRIBUTE_UUID;
    }
}
