<?php

namespace Neon\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Interface ModelRepository
 * @package Neon\Models\Repositories\Interfaces
 */
interface ModelRepository
{
    /**
     * @param string|null $status
     * @return EloquentModel[]|Collection
     */
    public function all(?string $status): array|Collection;

    /**
     * @param array $data
     * @return EloquentModel
     */
    public function create(array $data): EloquentModel;

    /**
     * @param EloquentModel $profieldReport
     * @param array  $data
     * @return EloquentModel
     */
    public function update(EloquentModel $model, array $data): EloquentModel;

    /**
     * @param EloquentModel $profieldReport
     * @return bool
     */
    public function delete(EloquentModel $model): bool;

    /**
     * @param string $key Value of the primary key.
     * @return EloquentModel|null
     */
    public function find(string $key): EloquentModel|null;

    /**
     * @param string $field
     * @param mixed  $value
     * @return EloquentModel|null
     */
    public function findBy(string $field, mixed $value): EloquentModel|null;


    /**
     * @param array $values
     * @return EloquentModel[]|Collection
     */
    public function findByFields(array $values): array|Collection;
}
