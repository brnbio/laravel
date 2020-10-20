<?php

declare(strict_types=1);

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * Class Model
 * @package App\Models
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
        if (empty(static::TABLE)) {
            return parent::getTable();
        }

        return static::TABLE;
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
     * @return int
     */
    public function getId(): int
    {
        return $this->getAttribute(self::ATTRIBUTE_ID);
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->getAttribute(self::ATTRIBUTE_UUID);
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::ATTRIBUTE_CREATED_AT);
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->getAttribute(self::ATTRIBUTE_UPDATED_AT);
    }

    /**
     * @return string
     */
    public function getCreatedAtColumn(): string
    {
        return self::ATTRIBUTE_CREATED_AT;
    }

    /**
     * @return string
     */
    public function getUpdatedAtColumn(): string
    {
        return self::ATTRIBUTE_UPDATED_AT;
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return self::ATTRIBUTE_UUID;
    }
}
