<?php

namespace Neon\Models\Repositories;

// use App\Domain\Core\Models\Role;
// use App\Domain\Merchandising\Filters\ProfieldReportFilter;
// use App\Domain\Merchandising\Models\EloquentModel;
use Neon\Models\Repositories\Interfaces\ModelRepository as ModelREpositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class ModelRepository
 * @package App\Domain\Merchandising\Repositories
 */
class ModelRepository implements ModelRepositryInterface
{
    /**
     * @var EloquentModel
     */
    private EloquentModel $model;

    /**
     * ModelRepository constructor.
     * @param EloquentModel $model
     */
    public function __construct(EloquentModel $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function all(?string $status): array|Collection
    {
        $query = $this->model->newQuery();
        
        if ($status) {
            $query->where('status', $status);
        }

        return $query->get();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): EloquentModel
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(EloquentModel $model, array $data): EloquentModel
    {
        $model->update($data);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function delete(EloquentModel $model): bool
    {
        return $model->delete();
    }

    /**
     * @inheritDoc
     */
    public function find(string $key): EloquentModel|null
    {
        return $this->model->newQuery()->where($this->model->getKeyName(), $value)->first();
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $key, mixed $value): EloquentModel|null
    {
        return $this->model->newQuery()->where($key, $value)->first();
    }

    /**
     * @inheritDoc
     */
    public function findByFields(array $values): array|Collection
    {
        $query = $this->model->newQuery();

        foreach ($values as $key => $value) {
            if (str_contains($key, '.')) {
                $relation = explode('.', $key);
                $query->whereHas($relation[0], function (Builder $q) use ($relation, $value) {
                    return $q->where($relation[1], $value);
                });
            } else {
                $query->where($key, $value);
            }
        }

        return $query->get();
    }
}
