<?php

declare(strict_types=1);

namespace App;

use App\Models\Concerns\HasUUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Carbon;

/**
 * Class Model
 *
 * @package App
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static static create(array $attributes = [])
 * @method static static find($id, $columns = ['*'])
 * @method static static findOrFail($id, $columns = ['*'])
 * @method static static first($columns = ['*'])
 * @method static Builder withCount($relations)
 */
class Model extends BaseModel
{
    use HasUUID;

    public const string TABLE = '';

    public const string ATTRIBUTE_ID = 'id';

    public const string ATTRIBUTE_CREATED_AT = 'created_at';

    public const string ATTRIBUTE_UPDATED_AT = 'updated_at';

    public const string ATTRIBUTE_DELETED_AT = 'deleted_at';

    public function getTable(): string
    {
        return static::TABLE ?: parent::getTable();
    }
}
