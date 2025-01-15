<?php

declare(strict_types=1);

namespace App;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class Repository
 *
 * @package App
 * @property Builder $query
 */
abstract class Repository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var Builder
     */
    protected Builder $query;

    /**
     * @return string
     */
    abstract protected function getModelClass(): string;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
        $this->query = $this->model->newModelQuery();
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->query;
    }

    /**
     * Get all items
     *
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->query()->get();
    }

    /**
     * Paginate items
     *
     * @param int|null $perPage
     * @param array $columns
     * @param string $pageName
     * @param int|null $page
     * @param int|null $total
     * @return LengthAwarePaginator
     */
    public function paginate(?int $perPage = null, array $columns = ['*'], string $pageName = 'page', ?int $page = null, ?int $total = null): LengthAwarePaginator
    {
        return $this->query()->paginate($perPage, $columns, $pageName, $page, $total);
    }

    /**
     * @param int $id
     * @param array $columns
     * @throw ModelNotFoundException
     * @return Model
     */
    public function find(int $id, array $columns = ['*']): Model
    {
        /** @var Model $instance */
        $instance = $this->query()->findOrFail($id, $columns);

        return $instance;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes = []): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param Model $instance
     * @param array $attributes
     * @param array $options
     * @return Model|false
     */
    public function update(Model $instance, array $attributes = [], array $options = []): Model|false
    {
        if ($instance->update($attributes, $options)) {
            return $instance;
        }

        return false;
    }

    /**
     * @param Model $instance
     * @return bool
     */
    public function delete(Model $instance): bool
    {
        return (bool) $instance->delete();
    }

    /**
     * @param string $option
     * @param string|null $key
     * @param array $except
     * @return array
     */
    public function options(string $option = 'name', ?string $key = null, array $except = []): array
    {
        $options = $this->query()
            ->when($except, function(Builder $query) use ($except) {
                $query->whereNotIn($this->model->getKeyName(), $except);
            })
            ->get();

        return $options
            ->map(function(Model $model) use ($option, $key) {
                return [
                    'id'   => $key ? $model->{$key} : $model->getKey(),
                    'text' => $model->{$option},
                ];
            })
            ->sortBy('text')
            ->values()
            ->toArray();
    }
}
